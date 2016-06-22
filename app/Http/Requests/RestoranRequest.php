<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RestoranRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*'imei' => 'required | min:3',
            'trackerPhone' => 'required',
            'balance' => 'required',
            'user_id' => 'required',*/
        ];
    }
}
