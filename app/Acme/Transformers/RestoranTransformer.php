<?php
namespace App\Acme\Transformers;

class RestoranTransformer extends Transformer{

	public function transform($restoran){
		return [

			'id' => $restoran['id'],
			'jenis_id'=> $restoran['jenis_id'],
			'nama'=> $restoran['nama'],
			'alamat'=> $restoran['alamat'],
			'namaPemilik'=> $restoran['namaPemilik'],
			'jmlMeja'=> $restoran['jmlMeja'],
			'jmlKursi'=> $restoran['jmlKursi'],
			'hidangan'=> $restoran['hidangan'],
			'telepon'=> $restoran['telepon']
		];
	}
}
