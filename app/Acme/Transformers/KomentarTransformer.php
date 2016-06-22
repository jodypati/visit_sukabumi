<?php
namespace App\Acme\Transformers;

class KomentarTransformer extends Transformer{

	public function transform($komentar){
		return [
			'komentar','comment_id','comment_type'
			'id' => $komentar['id'],
			'komentar' => $komentar['komentar'],
			'comment_id' => $komentar['comment_id'],
			'comment_type' => $komentar['comment_type'],
			'user_id' => $komentar['user_id'],
		];
	}
}
