<?php
namespace App\Acme\Transformers;

class BelanjaTransformer extends Transformer{

	public function transform($belanja){
		return [
      'id' => $belanja['id'],
			'nama' => $belanja['nama'],
			'alamat' => $belanja['alamat'],
			'jenis' => $belanja['jenis'],
			'keterangan' => $belanja['keterangan'],
			'latitude' => $belanja['latitude'],
			'longitude' => $belanja['longitude'],
			'foto_url' => $belanja['foto_url']
		];
	}
}
