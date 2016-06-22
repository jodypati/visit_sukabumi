<?php
namespace App\Acme\Transformers;

class JenisTransformer extends Transformer{

	public function transform($jenis){
		return [
			'id' => $jenis['id'],
			'nama'=> $jenis['nama']
		];
	}
}
