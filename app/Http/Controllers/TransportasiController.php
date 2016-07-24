<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Transportasi;
//use App\Book;
use Response;
use App\Acme\Transformers\TransportasiTransformer;
use Input;

class TransportasiController extends APIController
{

	protected $transportasiTransformer;

	function __construct(TransportasiTransformer $transportasiTransformer){
		$this->middleware('jwt.auth');
		$this->transportasiTransformer = $transportasiTransformer;
	}

	public function index()
	{
		$transportasis = Transportasi::all();
		return Response::json(
			$this->transportasiTransformer->transformCollection($transportasis->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $transportasi = Transportasi::find($id);

      if( ! $transportasi ){
          return $this->respondNotFound('Transportasi does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/transportasi/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/transportasi/', $imgUsrFileName
          );
          $transportasi->foto_url = $imgUsrFilePath;
          $transportasi->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$transportasi = Transportasi::create( $request->all());
		return $this->respondCreated('Transportasi sucessfully created.');
	}



	public function show($id)
	{
		$transportasi = Transportasi::find($id);

		if( ! $transportasi ){
			return $this->respondNotFound('Transportasi does not exists');
		}

		return $this->respond([
				$this->transportasiTransformer->transform($transportasi)
		]);
	}

	public function update(Request $request, $id)
    {
    	$transportasi = Transportasi::find($id);
        if( ! $transportasi ){
			return $this->respondNotFound('Transportasi does not exists');
		}else{
        	$transportasi->update($request->all());
        	return $this->respondCreated('Transportasi sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$transportasi = Transportasi::find($id);
    if( ! $transportasi ){
			return $this->respondNotFound('Transportasi does not exists');
		}else{
    		$transportasi = Transportasi::findOrFail($id);
        	$transportasi->delete();
        	return $this->respondCreated('Transportasi sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $transportasi = Transportasi::where('type',$type)->get();
    		if( ! $transportasi ){
    			return $this->respondNotFound('Transportasi does not exists');
    		}
    		return $this->respond(
    				$this->transportasiTransformer->transformCollection($transportasi->all())
    		);
	  }

}
