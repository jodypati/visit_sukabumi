<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\PelayananPublik;
//use App\Book;
use Response;
use App\Acme\Transformers\PelayananPublikTransformer;
use Input;

class PelayananPublikController extends APIController
{

	protected $pelayananPublikTransformer;

	function __construct(PelayananPublikTransformer $pelayananPublikTransformer){
		$this->middleware('jwt.auth');
		$this->pelayananPublikTransformer = $pelayananPublikTransformer;
	}

	public function index()
	{
		$pelayananPubliks = PelayananPublik::all();
		return Response::json(
			$this->pelayananPublikTransformer->transformCollection($pelayananPubliks->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $pelayananPublik = PelayananPublik::find($id);

      if( ! $pelayananPublik ){
          return $this->respondNotFound('PelayananPublik does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/pelayananPublik/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/pelayananPublik/', $imgUsrFileName
          );
          $pelayananPublik->foto_url = $imgUsrFilePath;
          $pelayananPublik->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$pelayananPublik = PelayananPublik::create( $request->all());
		return $this->respondCreated('PelayananPublik sucessfully created.');
	}



	public function show($id)
	{
		$pelayananPublik = PelayananPublik::find($id);

		if( ! $pelayananPublik ){
			return $this->respondNotFound('PelayananPublik does not exists');
		}

		return $this->respond(
				$this->pelayananPublikTransformer->transform($pelayananPublik)
		);
	}

	public function update(Request $request, $id)
    {
    	$pelayananPublik = PelayananPublik::find($id);
        if( ! $pelayananPublik ){
			return $this->respondNotFound('PelayananPublik does not exists');
		}else{
        	$pelayananPublik->update($request->all());
        	return $this->respondCreated('PelayananPublik sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$pelayananPublik = PelayananPublik::find($id);
    if( ! $pelayananPublik ){
			return $this->respondNotFound('PelayananPublik does not exists');
		}else{
    		$pelayananPublik = PelayananPublik::findOrFail($id);
        	$pelayananPublik->delete();
        	return $this->respondCreated('PelayananPublik sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $pelayananPublik = PelayananPublik::where('type',$type)->get();
    		if( ! $pelayananPublik ){
    			return $this->respondNotFound('PelayananPublik does not exists');
    		}
    		return $this->respond(
    				$this->pelayananPublikTransformer->transformCollection($pelayananPublik->all())
    		);
	  }

}
