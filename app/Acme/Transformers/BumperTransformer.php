<?php
namespace App\Acme\Transformers;

class BumperTransformer extends Transformer{

	public function transform($bumper){
		return [
			'id' => $bumper['id'],
			'alamat'=> $bumper['alamat'],
			'pemilik'=> $bumper['pemilik'],
			'luasLahan'=> $bumper['luasLahan'],
			'tarif'=> $bumper['tarif']
		];
	}
}
