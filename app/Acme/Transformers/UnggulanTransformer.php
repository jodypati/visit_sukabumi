<?php
namespace App\Acme\Transformers;

class UnggulanTransformer extends Transformer{

	public function transform($unggulan){
		return [
      'id' => $unggulan['id'],
			'nama' => $unggulan['nama'],
			'alamat' => $unggulan['alamat'],
			'deskripsi' => $unggulan['deskripsi'],
			'amenities' => $unggulan['amenities'],
			'attraction' => $unggulan['attraction'],
			'ancilliary' => $unggulan['ancilliary'],
			'accessibility' => $unggulan['accessibility'],
			'activities' => $unggulan['activities'],
			'attraction' => $unggulan['attraction'],
			'latitude' => $unggulan['latitude'],
			'longitude' => $unggulan['longitude'],
			'foto_url' => $unggulan['foto_url']
		];
	}
}
