<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Penginapan;
use App\Komentar;
use App\Rating;
use App\Jenis;
use App\Acme\Transformers\PenginapanTransformer;
use App\Http\Requests\PenginapanRequest;
use Response;

class PenginapanController extends APIController
{

	protected $penginapanTransformer;

	function __construct(PenginapanTransformer $penginapanTransformer){
		$this->middleware('jwt.auth');
		$this->penginapanTransformer = $penginapanTransformer;
	}

	public function index($id = null)
	{
		if($id){
			$penginapan = Penginapan::find($id);
			if( ! $penginapan ){
				return $this->respondNotFound('penginapan does not exists');
			}else{
				$penginapan = $penginapan->penginapan;
			}

		}else{
			$penginapan = Penginapan::all();
		}


		return Response::json(
			$this->penginapanTransformer->transformCollection($penginapan->all())
		, 200);
	}

	public function store(Request $request){
		$penginapan = Penginapan::create($request->all());
		return $this->respondCreated('Penginapan sucessfully created.');

	}

	public function komentar(Request $request,$id){
		$penginapan = Penginapan::find($id);
		if( ! $penginapan ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			$comment = new Komentar();
			$comment->komentar = $request["komentar"];
			$comment->komentar = $request["user_id"];
			$penginapan->komentar()->save($comment);
			return $this->respondCreated('Komentar penginapan sucessfully created.');
		}

	}

	public function rating(Request $request,$id){
		$penginapan = Penginapan::find($id);
		if( ! $penginapan ){
			return $this->respondNotFound('penginapan does not exists');
		}else{
			$rating = new Rating();
			$rating->rating = $request["rating"];
			$rating->user_id = $request["user_id"];
			$penginapan->rating()->save($rating);
			return $this->respondCreated('Rating penginapan sucessfully created.');
		}

	}



	public function show($id, $id2 = null)
	{

		$penginapan = $id2 ? Jenis::findOrFail($id)->penginapan->find($id2) : Penginapan::find($id);

		if( ! $penginapan ){
			return $this->respondNotFound('penginapan does not exists');
		}

		return $this->respond([
			$this->penginapanTransformer->transform($penginapan)
		]);

	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenginapanRequest $request, $id)
    {
        $penginapan = Penginapan::find($id);

        if( ! $penginapan ){
			return $this->respondNotFound('Penginapan does not exists');
		}else{
        	$penginapan->update($request->all());
        	return $this->respondCreated('Penginapan sucessfully updated.');
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
        $penginapan = Penginapan::find($id);

        if( ! $penginapan ){
			return $this->respondNotFound('Penginapan does not exists');
		}else{
        	$penginapan->delete();
        	return $this->respondCreated('Penginapan sucessfully deleted.');
    	}
    }

}
