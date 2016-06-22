<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Rating;
use App\Jenis;
use App\Acme\Transformers\RatingTransformer;
use App\Http\Requests\RatingRequest;
use Response;

class RatingController extends APIController
{

	protected $ratingTransformer;

	function __construct(RatingTransformer $ratingTransformer){
    $this->middleware('jwt.auth');
    $this->ratingTransformer = $ratingTransformer;
	}

	public function index($id = null)
	{
		if($id){
			$rating = Rating::find($id);
			if( ! $rating ){
				return $this->respondNotFound('rating does not exists');
			}else{
				$rating = $rating->rating;
			}

		}else{
			$rating = Rating::all();
		}


		return Response::json(
			$this->ratingTransformer->transformCollection($rating->all())
		, 200);
	}

	public function store(Request $request){
    $rating = Rating::create($request->all());
		return $this->respondCreated('Rating sucessfully created.');

	}


	public function show($id, $id2 = null)
	{

		$rating = $id2 ? Jenis::findOrFail($id)->rating->find($id2) : Rating::find($id);

		if( ! $rating ){
			return $this->respondNotFound('rating does not exists');
		}

		return $this->respond([
			$this->ratingTransformer->transform($rating)
		]);

	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RatingRequest $request, $id)
    {
        $rating = Rating::find($id);

        if( ! $rating ){
			return $this->respondNotFound('Rating does not exists');
		}else{
        	$rating->update($request->all());
        	return $this->respondCreated('Rating sucessfully updated.');
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
        $rating = Rating::find($id);

        if( ! $rating ){
			return $this->respondNotFound('Rating does not exists');
		}else{
        	$rating->delete();
        	return $this->respondCreated('Rating sucessfully deleted.');
    	}
    }

}
