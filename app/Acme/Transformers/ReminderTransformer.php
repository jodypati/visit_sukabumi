<?php
namespace App\Acme\Transformers;

class ReminderTransformer extends Transformer{
	
	public function transform($vaccineHistory){
		return [
			'id' => $vaccineHistory['id'],
			'month'=> $vaccineHistory['month'],
			'message'=> $vaccineHistory['message'],
			'attribute_id'=> $vaccineHistory['attribute_id']
		];
	}
}