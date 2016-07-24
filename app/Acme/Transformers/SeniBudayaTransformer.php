<?php
namespace App\Acme\Transformers;

class SeniBudayaTransformer extends Transformer{

	public function transform($seni_budaya){
		return [
      'id' => $seni_budaya['id'],
			'nama' => $seni_budaya['nama'],
			'deskripsi' => $seni_budaya['deskripsi'],
			'latitude' => $seni_budaya['latitude'],
			'longitude' => $seni_budaya['longitude'],
			'foto_url' => $seni_budaya['foto_url']
		];
	}
}
