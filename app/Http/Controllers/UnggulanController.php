<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Unggulan;
use App\Penginapan;
//use App\Book;
use Response;
use App\Acme\Transformers\UnggulanTransformer;
use Input;

class UnggulanController extends APIController
{

	protected $unggulanTransformer;

	function __construct(UnggulanTransformer $unggulanTransformer){
		$this->middleware('jwt.auth');
		$this->unggulanTransformer = $unggulanTransformer;
	}

	public function index()
	{
		$unggulans = Unggulan::all();
		return Response::json(
			$this->unggulanTransformer->transformCollection($unggulans->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $unggulan = Unggulan::find($id);

      if( ! $unggulan ){
          return $this->respondNotFound('Unggulan does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/unggulan/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/unggulan/', $imgUsrFileName
          );
          $unggulan->foto_url = $imgUsrFilePath;
          $unggulan->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$unggulan = Unggulan::create( $request->all());
		return $this->respondCreated('Unggulan sucessfully created.');
	}

  public function penginapan($id,$id2){
    Unggulan::find($id)->penginapan()->attach($id2);
    return $this->respondCreated('Penginapan unggulan sucessfully created.');
  }

  public function showPenginapan($id,$id2){
    //$unggulan = $id2 ? Unggulan::findOrFail($id)->penginapan->find($id2) : Unggulan::find($id)->penginapan;
    if($id2){
      $unggulan = Unggulan::findOrFail($id)->penginapan->find($id2);
      return $this->respond(
  			$this->unggulanTransformer->transform($unggulan)
  		);
    }else{
      $unggulan = Unggulan::find($id)->penginapan;
      return Response::json(
  			$this->unggulanTransformer->transformCollection($unggulan->all())
  		, 200);
    }
		if( ! $unggulan ){
			return $this->respondNotFound('unggulan does not exists');
		}


  }

	public function show($id)
	{
		$unggulan = Unggulan::find($id);

		if( ! $unggulan ){
			return $this->respondNotFound('Unggulan does not exists');
		}

		return $this->respond(
				$this->unggulanTransformer->transform($unggulan)
		);
	}

	public function update(Request $request, $id)
    {
    	$unggulan = Unggulan::find($id);
        if( ! $unggulan ){
			return $this->respondNotFound('Unggulan does not exists');
		}else{
        	$unggulan->update($request->all());
        	return $this->respondCreated('Unggulan sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$unggulan = Unggulan::find($id);
    if( ! $unggulan ){
			return $this->respondNotFound('Unggulan does not exists');
		}else{
    		$unggulan = Unggulan::findOrFail($id);
        	$unggulan->delete();
        	return $this->respondCreated('Unggulan sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $unggulan = Unggulan::where('type',$type)->get();
    		if( ! $unggulan ){
    			return $this->respondNotFound('Unggulan does not exists');
    		}
    		return $this->respond(
    				$this->unggulanTransformer->transformCollection($unggulan->all())
    		);
	  }

}
