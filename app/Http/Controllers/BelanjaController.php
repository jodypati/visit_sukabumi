<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Belanja;
//use App\Book;
use Response;
use App\Acme\Transformers\BelanjaTransformer;
use Input;

class BelanjaController extends APIController
{

	protected $belanjaTransformer;

	function __construct(BelanjaTransformer $belanjaTransformer){
		$this->middleware('jwt.auth');
		$this->belanjaTransformer = $belanjaTransformer;
	}

	public function index()
	{
		$belanjas = Belanja::all();
		return Response::json(
			$this->belanjaTransformer->transformCollection($belanjas->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $belanja = Belanja::find($id);

      if( ! $belanja ){
          return $this->respondNotFound('Belanja does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/belanja/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/belanja/', $imgUsrFileName
          );
          $belanja->foto_url = $imgUsrFilePath;
          $belanja->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$belanja = Belanja::create( $request->all());
		return $this->respondCreated('Belanja sucessfully created.');
	}



	public function show($id)
	{
		$belanja = Belanja::find($id);

		if( ! $belanja ){
			return $this->respondNotFound('Belanja does not exists');
		}

		return $this->respond(
				$this->belanjaTransformer->transform($belanja)
		);
	}

	public function update(Request $request, $id)
    {
    	$belanja = Belanja::find($id);
        if( ! $belanja ){
			return $this->respondNotFound('Belanja does not exists');
		}else{
        	$belanja->update($request->all());
        	return $this->respondCreated('Belanja sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$belanja = Belanja::find($id);
    if( ! $belanja ){
			return $this->respondNotFound('Belanja does not exists');
		}else{
    		$belanja = Belanja::findOrFail($id);
        	$belanja->delete();
        	return $this->respondCreated('Belanja sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $belanja = Belanja::where('type',$type)->get();
    		if( ! $belanja ){
    			return $this->respondNotFound('Belanja does not exists');
    		}
    		return $this->respond(
    				$this->belanjaTransformer->transformCollection($belanja->all())
    		);
	  }

}
