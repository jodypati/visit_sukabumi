<?php
namespace App\Acme\Transformers;

class AktivitasTransformer extends Transformer{

	public function transform($fasilitas){
		return [
      'id' => $fasilitas['id'],
			'nama' => $fasilitas['nama'],
			'deskripsi' => $fasilitas['deskripsi'],
			'foto_url' => $fasilitas['foto_url']
		];
	}
}
