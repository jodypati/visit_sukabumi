<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Komentar;
use App\Jenis;
use App\Acme\Transformers\KomentarTransformer;
use App\Http\Requests\KomentarRequest;
use Response;

class KomentarController extends APIController
{

	protected $komentarTransformer;

	function __construct(KomentarTransformer $komentarTransformer){
		$this->komentarTransformer = $komentarTransformer;
	}

	public function index($id = null)
	{
		if($id){
			$komentar = Komentar::find($id);
			if( ! $komentar ){
				return $this->respondNotFound('komentar does not exists');
			}else{
				$komentar = $komentar->komentar;
			}

		}else{
			$komentar = Komentar::all();
		}


		return Response::json(
			$this->komentarTransformer->transformCollection($komentar->all())
		, 200);
	}

	public function store(Request $request){
    $komentar = Komentar::create($request->all());
		return $this->respondCreated('Komentar sucessfully created.');

	}

	
	public function show($id, $id2 = null)
	{

		$komentar = $id2 ? Jenis::findOrFail($id)->komentar->find($id2) : Komentar::find($id);

		if( ! $komentar ){
			return $this->respondNotFound('komentar does not exists');
		}

		return $this->respond([
			$this->komentarTransformer->transform($komentar)
		]);

	}

	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KomentarRequest $request, $id)
    {
        $komentar = Komentar::find($id);

        if( ! $komentar ){
			return $this->respondNotFound('Komentar does not exists');
		}else{
        	$komentar->update($request->all());
        	return $this->respondCreated('Komentar sucessfully updated.');
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
        $komentar = Komentar::find($id);

        if( ! $komentar ){
			return $this->respondNotFound('Komentar does not exists');
		}else{
        	$komentar->delete();
        	return $this->respondCreated('Komentar sucessfully deleted.');
    	}
    }

}
