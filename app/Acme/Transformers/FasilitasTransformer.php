<?php
namespace App\Acme\Transformers;

class FasilitasTransformer extends Transformer{

	public function transform($fasilitas){
		return [
      'id' => $fasilitas['id'],
			'name' => $fasilitas['name'],
			'jenis_id' => $fasilitas['jenis_id']
		];
	}
}
