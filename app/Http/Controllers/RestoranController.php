<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RestoranRequest;
use App\Http\Requests\UploadRequest;
use App\Restoran;
use App\Komentar;
use App\Rating;
use Response;
use App\Acme\Transformers\RestoranTransformer;
use Input;

class RestoranController extends APIController
{

	protected $restoranTransformer;

	function __construct(RestoranTransformer $restoranTransformer){
		//['only' => ['store','update','destroy','upload','show']]
		$this->middleware('jwt.auth');
		$this->restoranTransformer = $restoranTransformer;
		//$this->middleware('jwt.refresh');

	}

	public function index()
	{
		$restoran = Restoran::all();
		return Response::json(
			$this->restoranTransformer->transformCollection($restoran->all())
		, 200);

	}
/*
    public function create()
    {
    }*/

    public function store(RestoranRequest $request){

			$restoran = Restoran::create($request->all());
			return $this->respondCreated('Restoran sucessfully created.');

		}

		public function upload(Request $request,$id){
				$foto_url = null;
				$restoran = Restoran::find($id);
	      if( ! $restoran ){
						return $this->respondNotFound('User does not exists');
				}
	      if($request->hasFile('foto_url')){
	          $imgUsrFileName = time().'.'.$request->file('foto_url')->getClientOriginalExtension();
	          $imgUsrFilePath = '/images/restoran/' .$imgUsrFileName;
	          $request->file('foto_url')->move(
	                base_path() . '/public/images/restoran/', $imgUsrFileName
	          );
	          $restoran->foto_url = $imgUsrFilePath;
	        	$restoran->save();
	        	return $this->respondCreated('Photo sucessfully uploaded.');
	        }else{
	        	return $this->respondCreated('Doesnt provide an image.');
	        }

		}

		public function komentar(Request $request,$id){
			$restoran = Restoran::find($id);
			if( ! $restoran ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				$comment = new Komentar();
				$comment->komentar = $request["komentar"];
				$comment->user_id = $request["user_id"];
				$restoran->komentar()->save($comment);
				return $this->respondCreated('Komentar penginapan sucessfully created.');
			}

		}

		public function getKomentar($id){
			$restoran = Restoran::find($id);
			if( ! $restoran ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				//restoran->komentar()->save($comment);
				return Response::json(
					$this->komentarTransformer->transformCollection($restoran->komentar->all())
					, 200);
			}
		}

		public function getRating($id){
			$restoran = Restoran::find($id);
			if( ! $restoran ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				//$restoran->komentar()->save($comment);
				return Response::json(
					$this->ratingTransformer->transformCollection($restoran->rating->all())
					, 200);
			}
		}

		public function rating(Request $request,$id){
			$restoran = Restoran::find($id);
			if( ! $restoran ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				$rating = new Rating();
				$rating->rating = $request["rating"];
				$rating->user_id = $request["user_id"];
				$restoran->rating()->save($rating);
				return $this->respondCreated('Rating penginapan sucessfully created.');
			}

		}


	public function show($id)
	{
		$restoran = Restoran::find($id);

		if( ! $restoran ){
			return $this->respondNotFound('Restoran does not exists');
		}

		return $this->respond(
			$this->restoranTransformer->transform($restoran)
		);
	}


/*
    public function edit($id)
    {
    }
*/

    public function update(RestoranRequest $request, $id)
    {
    		$restoran = Restoran::find($id);
        if( ! $restoran ){
					return $this->respondNotFound('Restoran does not exists');
				}else{
        	$restoran->update($request->all());
        	return $this->respondCreated('Restoran sucessfully updated.');
    		}
    }

    public function destroy($id)
    {
    	$restoran = Restoran::find($id);
        if( ! $restoran ){
			return $this->respondNotFound('Restoran does not exists');
		}else{
    		$restoran = Restoran::findOrFail($id);
        	$restoran->delete();
        	return $this->respondCreated('Restoran sucessfully deleted.');
    	}
    }
    /*
	private function transformCollection($restoran){
		return array_map([$this,'transform'], $restoran->toArray());
	}

	private function transform($restoran){
		return[
			'name' => $restoran['name'],
			'gender' => $restoran['gender']
		];
	}*/
}
