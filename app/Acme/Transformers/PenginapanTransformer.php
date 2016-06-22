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
			'jmlTempatTidur' => $penginapan['avatarURL'],
			'tarif' => $penginapan['tarif'],
			'bintang' => $penginapan['bintang'],
			'telepon' => $penginapan['telepon'],
			'email' => $penginapan['email'],
			'jenis_id' => $penginapan['jenis_id']
		];
	}
}
