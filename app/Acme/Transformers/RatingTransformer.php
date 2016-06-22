<?php
namespace App\Acme\Transformers;

class RatingTransformer extends Transformer{

	public function transform($rating){
		return [
			'id' => $rating['id'],
			'rating' => $rating['rating'],
			'rate_id' => $rating['rate_id'],
			'rate_type' => $rating['rate_type'],
			'user_id' => $rating['user_id'],
		];
	}
}
