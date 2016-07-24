<?php
namespace App\Acme\Transformers;

class PelayananPublikTransformer extends Transformer{

	public function transform($pelayananPublik){
		return [
      'id' => $pelayananPublik['id'],
			'nama' => $pelayananPublik['nama'],
			'alamat' => $pelayananPublik['alamat'],
			'jenis' => $pelayananPublik['jenis'],
			'keterangan' => $pelayananPublik['keterangan'],
			'latitude' => $pelayananPublik['latitude'],
			'longitude' => $pelayananPublik['longitude'],
			'foto_url' => $pelayananPublik['foto_url']
		];
	}
}
