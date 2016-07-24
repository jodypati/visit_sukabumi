<?php
namespace App\Acme\Transformers;

class RestoranTransformer extends Transformer{

	public function transform($restoran){
		return [

			'id' => $restoran['id'],
			'jenis'=> $restoran['jenis'],
			'nama'=> $restoran['nama'],
			'alamat'=> $restoran['alamat'],
			'namaPemilik'=> $restoran['namaPemilik'],
			'jmlMeja'=> $restoran['jmlMeja'],
			'jmlKursi'=> $restoran['jmlKursi'],
			'hidangan'=> $restoran['hidangan'],
			'telepon'=> $restoran['telepon'],
			'keterangan'=> $restoran['keterangan'],
			'foto_url'=> $restoran['foto_url'],
			'latitude'=> $restoran['latitude'],
			'longitude'=> $restoran['longitude']
		];
	}
}
