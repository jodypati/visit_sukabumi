<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\SeniBudaya;
//use App\Book;
use Response;
use App\Acme\Transformers\SeniBudayaTransformer;
use Input;

class SeniBudayaController extends APIController
{

	protected $seni_budayaTransformer;

	function __construct(SeniBudayaTransformer $seni_budayaTransformer){
		$this->middleware('jwt.auth');
		$this->seni_budayaTransformer = $seni_budayaTransformer;
	}

	public function index()
	{
		$seni_budayas = SeniBudaya::all();
		return Response::json(
			$this->seni_budayaTransformer->transformCollection($seni_budayas->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $seni_budaya = SeniBudaya::find($id);

      if( ! $seni_budaya ){
          return $this->respondNotFound('SeniBudaya does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/seni_budaya/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/seni_budaya/', $imgUsrFileName
          );
          $seni_budaya->foto_url = $imgUsrFilePath;
          $seni_budaya->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$seni_budaya = SeniBudaya::create( $request->all());
		return $this->respondCreated('SeniBudaya sucessfully created.');
	}



	public function show($id)
	{
		$seni_budaya = SeniBudaya::find($id);

		if( ! $seni_budaya ){
			return $this->respondNotFound('SeniBudaya does not exists');
		}

		return $this->respond([
				$this->seni_budayaTransformer->transform($seni_budaya)
		]);
	}

	public function update(Request $request, $id)
    {
    	$seni_budaya = SeniBudaya::find($id);
        if( ! $seni_budaya ){
			return $this->respondNotFound('SeniBudaya does not exists');
		}else{
        	$seni_budaya->update($request->all());
        	return $this->respondCreated('SeniBudaya sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$seni_budaya = SeniBudaya::find($id);
    if( ! $seni_budaya ){
			return $this->respondNotFound('SeniBudaya does not exists');
		}else{
    		$seni_budaya = SeniBudaya::findOrFail($id);
        	$seni_budaya->delete();
        	return $this->respondCreated('SeniBudaya sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $seni_budaya = SeniBudaya::where('type',$type)->get();
    		if( ! $seni_budaya ){
    			return $this->respondNotFound('SeniBudaya does not exists');
    		}
    		return $this->respond(
    				$this->seni_budayaTransformer->transformCollection($seni_budaya->all())
    		);
	  }

}
