<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Attribute;
//use App\Book;
use Response;
use App\Acme\Transformers\AttributeTransformer;
use Input;

class AttributesAPIController extends APIController
{
	
	protected $attributeTransformer;
	
	function __construct(AttributeTransformer $attributeTransformer){
		$this->middleware('jwt.auth',['only' => 'store']);		
		$this->attributeTransformer = $attributeTransformer;
	}
	
	public function index()
	{
		$attributes = Attribute::all();
		return Response::json(
			$this->attributeTransformer->transformCollection($attributes->all())
		, 200);
		
	}
/*
    public function create()
    {
    }*/

    public function store(AttributeRequest $request){
		//if( ! Input::get('name') or ! Input::get('gender')){
			//return $this->setStatusCode(422)
			//			->respondWithError('Parameters failed validation for an Attribute.');
		//}
		
		$attribute = attribute::create( $request->all());
		return $this->respondCreated('Attribute sucessfully created.');
		/*return $this->setStatusCode(201)->respond([
			'message' => 'Attribute sucessfully created.',
		]);*/
	}

	public function show($id)
	{
		$attribute = Attribute::find($id);

		if( ! $attribute ){
			return $this->respondNotFound('Attribute does not exists');
		}
		
		return $this->respond([
				$this->attributeTransformer->transform($attribute)
		]);
		//return Response::json([
			//'data' => $attribute->toArray()
			//'data' => $this->transform($attribute->toArray())
			//'data'=>$this->attributeTransformer->transform($attribute)
		//], 200);
	}
	public function update(AttributeRequest $request, $id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('Attribute does not exists');
		}else{
        	$user->update($request->all());
        	return $this->respondCreated('Attribute sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('Attribute does not exists');
		}else{
    		$user = user::findOrFail($id);
        	$user->delete();
        	return $this->respondCreated('Attribute sucessfully deleted.');
    	}
    }

    public function shows($type){
		$attribute = Attribute::where('type',$type)->get();
		if( ! $attribute ){
			return $this->respondNotFound('Attribute does not exists');
		}
		return $this->respond(
				$this->attributeTransformer->transformCollection($attribute->all())
		);
	}
	
}
