<?php
namespace App\Acme\Transformers;

class ObjekWisataTransformer extends Transformer{

	public function transform($objek_wisata){
		return [
      'id' => $objek_wisata['id'],
			'nama' => $objek_wisata['nama'],
			'alamat' => $objek_wisata['alamat'],
			'jenis' => $objek_wisata['jenis'],
			'deskripsi' => $objek_wisata['deskripsi'],
			'latitude' => $objek_wisata['latitude'],
			'longitude' => $objek_wisata['longitude'],
			'foto_url' => $objek_wisata['foto_url']
		];
	}
}
