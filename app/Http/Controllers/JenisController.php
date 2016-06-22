<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\JenisRequest;
use App\Http\Requests\UploadRequest;
use App\Jenis;
use Response;
use App\Acme\Transformers\JenisTransformer;
use Input;

class JenisController extends APIController
{

	protected $jenisTransformer;

	function __construct(JenisTransformer $jenisTransformer){
		//['only' => ['store','update','destroy','upload','show']]
		$this->middleware('jwt.auth');
		$this->jenisTransformer = $jenisTransformer;
		//$this->middleware('jwt.refresh');

	}

		public function index()
		{
			$jenis = Jenis::all();
			return Response::json(
				$this->jenisTransformer->transformCollection($jenis->all())
				, 200);

		}


    public function store(Request $request){
			$jenis = Jenis::create($request->all());
			return $this->respondCreated('Jenis sucessfully created.');

		}

	public function show($id)
	{
		$jenis = Jenis::find($id);

		if( ! $jenis ){
			return $this->respondNotFound('Jenis does not exists');
		}

		return $this->respond(
			$this->jenisTransformer->transform($jenis)
		);
	}


/*
    public function edit($id)
    {
    }
*/

    public function update(JenisRequest $request, $id)
    {
    		$jenis = Jenis::find($id);
        if( ! $jenis ){
					return $this->respondNotFound('Jenis does not exists');
				}else{
        	$jenis->update($request->all());
        	return $this->respondCreated('Jenis sucessfully updated.');
    		}
    }

    public function destroy($id)
    {
    	$jenis = Jenis::find($id);
        if( ! $jenis ){
			return $this->respondNotFound('Jenis does not exists');
		}else{
    		$jenis = Jenis::findOrFail($id);
        	$jenis->delete();
        	return $this->respondCreated('Jenis sucessfully deleted.');
    	}
    }
    /*
	private function transformCollection($jenis){
		return array_map([$this,'transform'], $jenis->toArray());
	}

	private function transform($jenis){
		return[
			'name' => $jenis['name'],
			'gender' => $jenis['gender']
		];
	}*/
}
