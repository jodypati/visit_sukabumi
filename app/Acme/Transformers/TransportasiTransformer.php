<?php
namespace App\Acme\Transformers;

class TransportasiTransformer extends Transformer{

	public function transform($belanja){
		return [
      'id' => $belanja['id'],
			'nama' => $belanja['nama'],
			'alamat' => $belanja['alamat'],
			'jenis' => $belanja['jenis'],
			'latitude' => $belanja['latitude'],
			'longitude' => $belanja['longitude'],
			'foto_url' => $belanja['foto_url']
		];
	}
}
