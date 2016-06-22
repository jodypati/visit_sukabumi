<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Fasilitas;
//use App\Book;
use Response;
use App\Acme\Transformers\FasilitasTransformer;
use Input;

class FasilitasController extends APIController
{

	protected $fasilitasTransformer;

	function __construct(FasilitasTransformer $fasilitasTransformer){
		$this->middleware('jwt.auth');
		$this->fasilitasTransformer = $fasilitasTransformer;
	}

	public function index()
	{
		$fasilitass = Fasilitas::all();
		return Response::json(
			$this->fasilitasTransformer->transformCollection($fasilitass->all())
		, 200);

	}
/*
    public function create()
    {
    }*/

  public function store(Request $request){
		$fasilitas = Fasilitas::create( $request->all());
		return $this->respondCreated('Fasilitas sucessfully created.');
	}

	public function penginapan($id,$id2){
		Fasilitas::find($id)->penginapan()->attach($id2);
	}

	public function restoran($id,$id2){
		Fasilitas::find($id)->restoran()->attach($id2);
	}

	public function bumper($id,$id2){
		Fasilitas::find($id)->bumper()->attach($id2);
	}

	public function show($id)
	{
		$fasilitas = Fasilitas::find($id);

		if( ! $fasilitas ){
			return $this->respondNotFound('Fasilitas does not exists');
		}

		return $this->respond([
				$this->fasilitasTransformer->transform($fasilitas)
		]);
		//return Response::json([
			//'data' => $fasilitas->toArray()
			//'data' => $this->transform($fasilitas->toArray())
			//'data'=>$this->fasilitasTransformer->transform($fasilitas)
		//], 200);
	}
	public function update(Request $request, $id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('Fasilitas does not exists');
		}else{
        	$user->update($request->all());
        	return $this->respondCreated('Fasilitas sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('Fasilitas does not exists');
		}else{
    		$user = user::findOrFail($id);
        	$user->delete();
        	return $this->respondCreated('Fasilitas sucessfully deleted.');
    	}
    }

    public function shows($type){
		$fasilitas = Fasilitas::where('type',$type)->get();
		if( ! $fasilitas ){
			return $this->respondNotFound('Fasilitas does not exists');
		}
		return $this->respond(
				$this->fasilitasTransformer->transformCollection($fasilitas->all())
		);
	}

}
