<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Aktivitas;
//use App\Book;
use Response;
use App\Acme\Transformers\AktivitasTransformer;
use Input;

class AktivitasController extends APIController
{

	protected $aktivitasTransformer;

	function __construct(AktivitasTransformer $aktivitasTransformer){
		$this->middleware('jwt.auth');
		$this->aktivitasTransformer = $aktivitasTransformer;
	}

	public function index()
	{
		$aktivitass = Aktivitas::all();
		return Response::json(
			$this->aktivitasTransformer->transformCollection($aktivitass->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $aktivitas = Aktivitas::find($id);

      if( ! $aktivitas ){
          return $this->respondNotFound('Aktivitas does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/aktivitas/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/aktivitas/', $imgUsrFileName
          );
          $aktivitas->foto_url = $imgUsrFilePath;
          $aktivitas->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$aktivitas = Aktivitas::create( $request->all());
		return $this->respondCreated('Aktivitas sucessfully created.');
	}



	public function show($id)
	{
		$aktivitas = Aktivitas::find($id);

		if( ! $aktivitas ){
			return $this->respondNotFound('Aktivitas does not exists');
		}

		return $this->respond(
				$this->aktivitasTransformer->transform($aktivitas)
		);
	}

	public function update(Request $request, $id)
    {
    	$aktivitas = Aktivitas::find($id);
        if( ! $aktivitas ){
			return $this->respondNotFound('Aktivitas does not exists');
		}else{
        	$aktivitas->update($request->all());
        	return $this->respondCreated('Aktivitas sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$aktivitas = Aktivitas::find($id);
    if( ! $aktivitas ){
			return $this->respondNotFound('Aktivitas does not exists');
		}else{
    		$aktivitas = Aktivitas::findOrFail($id);
        	$aktivitas->delete();
        	return $this->respondCreated('Aktivitas sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $aktivitas = Aktivitas::where('type',$type)->get();
    		if( ! $aktivitas ){
    			return $this->respondNotFound('Aktivitas does not exists');
    		}
    		return $this->respond(
    				$this->aktivitasTransformer->transformCollection($aktivitas->all())
    		);
	  }

}
