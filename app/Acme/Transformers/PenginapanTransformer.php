<?php
namespace App\Acme\Transformers;

class PenginapanTransformer extends Transformer{

	public function transform($penginapan){
		return [
      'id' => $penginapan['id'],
			'nama' => $penginapan['nama'],
			'alamat' => $penginapan['alamat'],
			'namaPemilik' => $penginapan['namaPemilik'],
			'jmlKamar' => $penginapan['alamat'],
			'jmlTempatTidur' => $penginapan['jmlTempatTidur'],
			'tarif' => $penginapan['tarif'],
			'bintang' => $penginapan['bintang'],
			'telepon' => $penginapan['telepon'],
			'email' => $penginapan['email'],
			'jenis' => $penginapan['jenis'],
			'fasilitas' => $penginapan['fasilitas'],
			'keterangan' => $penginapan['keterangan'],
			'foto_url' => $penginapan['foto_url'],
			'latitude' => $penginapan['latitude'],
			'longitude' => $penginapan['longitude']
		];
	}
}
