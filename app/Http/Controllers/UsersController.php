<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
//use App\Http\Controllers\Controller;
//use App\Http\Requests\Request;
use App\Http\Requests\UploadRequest;
use App\User;
//use App\Book;
use Response;
use App\Acme\Transformers\UserTransformer;
use Input;

class UsersController extends APIController
{

	protected $userTransformer;

	function __construct(UserTransformer $userTransformer){
		//['only' => ['store','update','destroy','upload','show']]
		//$this->middleware('jwt.auth');
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


  public function store(Request $request){
			if( ! Input::get('name') or ! Input::get('gender')){
				return $this->setStatusCode(422)
							->respondWithError('Parameters failed validation for an User.');
			}
			$user = User::create($request->all());
			return $this->respondCreated('User sucessfully created.');

	}

	public function show($id)
	{
		$user = User::find($id);

		if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}

		return $this->respond(
			$this->userTransformer->transform($user)
		);
	}

	public function upload(Request $request,$id){
			$avatarURL = null;
			$user = User::find($id);

      if( ! $user ){
					return $this->respondNotFound('User does not exists');
			}
      if($request->hasFile('avatarURL')){
          $imgUsrFileName = time().'.'.$request->file('avatarURL')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/users/' .$imgUsrFileName;
          $request->file('avatarURL')->move(
                base_path() . '/public/images/users/', $imgUsrFileName
          );
          $user->avatarURL = $imgUsrFilePath;
        	$user->save();
        	return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
        	return $this->respondCreated('Doesnt provide an image.');
        }

	}

    public function update(Request $request, $id)
    {
			echo $request["name"]."name";
			$user = User::find($id);
			print_r($user);
			if( ! $user ){
				return $this->respondNotFound('User does not exists');
			}else{

        	$user->update($request->all());
        	return $this->respondCreated('User sucessfully updated.');
    	}
    }

    public function destroy($id)
    {
    	$user = User::find($id);
        if( ! $user ){
			return $this->respondNotFound('User does not exists');
		}else{
    		$user = User::findOrFail($id);
        	$user->delete();
        	return $this->respondCreated('User sucessfully deleted.');
    	}
    }
}
