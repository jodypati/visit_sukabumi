<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\ObjekWisata;
//use App\Book;
use Response;
use App\Acme\Transformers\ObjekWisataTransformer;
use Input;

class ObjekWisataController extends APIController
{

	protected $objek_wisataTransformer;

	function __construct(ObjekWisataTransformer $objek_wisataTransformer){
		$this->middleware('jwt.auth');
		$this->objek_wisataTransformer = $objek_wisataTransformer;
	}

	public function index()
	{
		$objek_wisatas = ObjekWisata::all();
		return Response::json(
			$this->objek_wisataTransformer->transformCollection($objek_wisatas->all())
		, 200);

	}

  public function upload(Request $request,$id){
      $foto_url = null;
      $objek_wisata = ObjekWisata::find($id);

      if( ! $objek_wisata ){
          return $this->respondNotFound('ObjekWisata does not exists');
      }
      if($request->hasFile('foto_url')){
          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/objek_wisata/' .$imgUsrFileName;
          $request->file('foto_url')->move(
                base_path() . '/public/images/objek_wisata/', $imgUsrFileName
          );
          $objek_wisata->foto_url = $imgUsrFilePath;
          $objek_wisata->save();
          return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
          return $this->respondCreated('Doesnt provide an image.');
        }

  }

  public function store(Request $request){
		$objek_wisata = ObjekWisata::create( $request->all());
		return $this->respondCreated('ObjekWisata sucessfully created.');
	}



	public function show($id)
	{
		$objek_wisata = ObjekWisata::find($id);

		if( ! $objek_wisata ){
			return $this->respondNotFound('ObjekWisata does not exists');
		}

		return $this->respond(
				$this->objek_wisataTransformer->transform($objek_wisata)
		);
	}

	public function update(Request $request, $id)
    {
    	$objek_wisata = ObjekWisata::find($id);
        if( ! $objek_wisata ){
			return $this->respondNotFound('ObjekWisata does not exists');
		}else{
        	$objek_wisata->update($request->all());
        	return $this->respondCreated('ObjekWisata sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$objek_wisata = ObjekWisata::find($id);
    if( ! $objek_wisata ){
			return $this->respondNotFound('ObjekWisata does not exists');
		}else{
    		$objek_wisata = ObjekWisata::findOrFail($id);
        	$objek_wisata->delete();
        	return $this->respondCreated('ObjekWisata sucessfully deleted.');
    	}
    }

    public function shows($type){
		    $objek_wisata = ObjekWisata::where('type',$type)->get();
    		if( ! $objek_wisata ){
    			return $this->respondNotFound('ObjekWisata does not exists');
    		}
    		return $this->respond(
    				$this->objek_wisataTransformer->transformCollection($objek_wisata->all())
    		);
	  }

}
