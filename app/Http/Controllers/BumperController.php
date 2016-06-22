<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Bumper;
use App\Komentar;
use App\Rating;
use App\Jenis;
use App\Acme\Transformers\BumperTransformer;
use App\Http\Requests\BumperRequest;
use Response;

class BumperController extends APIController
{

	protected $bumperTransformer;

	function __construct(BumperTransformer $bumperTransformer){
		$this->middleware('jwt.auth');
		$this->penginapanTransformer = $bumperTransformer;
	}

	public function index($id = null)
	{
		if($id){
			$bumper = Bumper::find($id);
			if( ! $bumper ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				$bumper = $bumper->penginapan;
			}

		}else{
			$bumper = Bumper::all();
		}


		return Response::json(
			$this->penginapanTransformer->transformCollection($bumper->all())
		, 200);
	}

	public function store(Request $request){
		$bumper = Bumper::create($request->all());
		return $this->respondCreated('Bumper sucessfully created.');

	}

	public function upload(Request $request,$id){
			$imageURL = null;
			$bumper = Bumper::find($id);
      if( ! $bumper ){
					return $this->respondNotFound('User does not exists');
			}
      if($request->hasFile('imageURL')){
          $imgUsrFileName = time().'.'.$request->file('imageURL')->getClientOriginalExtension();
          $imgUsrFilePath = '/images/bumper/' .$imgUsrFileName;
          $request->file('imageURL')->move(
                base_path() . '/public/images/bumper/', $imgUsrFileName
          );
          $bumper->imageURL = $imgUsrFilePath;
        	$bumper->save();
        	return $this->respondCreated('Photo sucessfully uploaded.');
        }else{
        	return $this->respondCreated('Doesnt provide an image.');
        }

	}

	public function komentar(Request $request,$id){
		$bumper = Bumper::find($id);
		if( ! $bumper ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			$comment = new Komentar();
			$comment->komentar = $request["komentar"];
			$comment->user_id = $request["user_id"];
			$bumper->komentar()->save($comment);
			return $this->respondCreated('Komentar penginapan sucessfully created.');
		}

	}

	public function getKomentar($id){
		$bumper = Bumper::find($id);
		if( ! $bumper ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			//$bumper->komentar()->save($comment);
			return Response::json(
				$this->komentarTransformer->transformCollection($bumper->komentar->all())
				, 200);
		}
	}

	public function getRating($id){
		$bumper = Bumper::find($id);
		if( ! $bumper ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			//$bumper->komentar()->save($comment);
			return Response::json(
				$this->ratingTransformer->transformCollection($bumper->rating->all())
				, 200);
		}
	}

	public function rating(Request $request,$id){
		$bumper = Bumper::find($id);
		if( ! $bumper ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			$rating = new Rating();
			$rating->rating = $request["rating"];
			$rating->user_id = $request["user_id"];
			$bumper->rating()->save($rating);
			return $this->respondCreated('Rating penginapan sucessfully created.');
		}

	}



	public function show($id, $id2 = null)
	{

		$bumper = $id2 ? Jenis::findOrFail($id)->penginapan->find($id2) : Bumper::find($id);

		if( ! $bumper ){
			return $this->respondNotFound('penginapan does not exists');
		}

		return $this->respond([
			$this->penginapanTransformer->transform($bumper)
		]);

	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BumperRequest $request, $id)
    {
        $bumper = Bumper::find($id);

        if( ! $bumper ){
			return $this->respondNotFound('Bumper does not exists');
		}else{
        	$bumper->update($request->all());
        	return $this->respondCreated('Bumper sucessfully updated.');
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bumper = Bumper::find($id);

        if( ! $bumper ){
			return $this->respondNotFound('Bumper does not exists');
		}else{
        	$bumper->delete();
        	return $this->respondCreated('Bumper sucessfully deleted.');
    	}
    }

}
