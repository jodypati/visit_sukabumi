<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UploadRequest;
use App\User;
//use App\Book;
use Response;
use App\Acme\Transformers\UserTransformer;
use Input;

class UsersAPIController extends APIController
{
	
	protected $userTransformer;
	
	function __construct(UserTransformer $userTransformer){
		//['only' => ['store','update','destroy','upload','show']]
		$this->middleware('jwt.auth');		
		$this->userTransformer = $userTransformer;
		//$this->middleware('jwt.refresh');

	}
	
	public function index()
	{
		$users = User::all();
		return Response::json(
			$this->userTransformer->transformCollection($users->all())
		, 200);
		
	}
/*
    public function create()
    {
    }*/

    public function store(UserRequest $request){
		if( ! Input::get('name') or ! Input::get('gender')){
			return $this->setStatusCode(422)
						->respondWithError('Parameters failed validation for an User.');
		}
		$user = user::create($request->all());
		return $this->respondCreated('User sucessfully created.');
		/*return $this->setStatusCode(201)->respond([
			'message' => 'User sucessfully created.',
		]);*/
	}

	public function show($id)
	{
		$user = User::find($id);

		if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}
		
		return $this->respond([
			$this->userTransformer->transform($user)
		]);
		//return Response::json([
			//'data' => $user->toArray()
			//'data' => $this->transform($user->toArray())
			//'data'=>$this->userTransformer->transform($user)
		//], 200);
	}

	public function upload(Request $request,$id){
		$imgUsrFileName = null;
		$imgUsrFilePath = null;
        $user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}
        if($request->hasFile('image')){
            $imgUsrFileName = time().'.'.$request->file('image')->getClientOriginalExtension();
            $imgUsrFilePath = '/images/parents/' .$imgUsrFileName;
            $request->file('image')->move(
                base_path() . '/public/images/parents/', $imgUsrFileName
            );
            $request['imgUsrFileName'] = $imgUsrFileName;
            $request['imgUsrFilePath'] = $imgUsrFilePath;

            
        	$user->update($request->all());
        	return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
        	return $this->respondCreated('Doesnt provide an image.');
        }
        
	}
/*
    public function edit($id)
    {
    }
*/

    public function update(UserRequest $request, $id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}else{
        	$user->update($request->all());
        	return $this->respondCreated('User sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$user = user::find($id);
        if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}else{
    		$user = user::findOrFail($id);
        	$user->delete();
        	return $this->respondCreated('User sucessfully deleted.');
    	}
    }
    /*
	private function transformCollection($users){
		return array_map([$this,'transform'], $users->toArray());
	}
	
	private function transform($user){
		return[
			'name' => $user['name'],
			'gender' => $user['gender']
		];
	}*/
}
