<?php
namespace App\Acme\Transformers;

class UserTransformer extends Transformer{

	public function transform($user){
		return [
			'id' => $user['id'],
			'name' => $user['name'],
			'email' => $user['email'],
			'telepon' => $user['telepon'],
			'alamat' => $user['alamat'],
			'avatarURL' => $user['avatarURL'],
			'verified' => $user['verified']
		];
	}
}
