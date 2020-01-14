<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class ShWorkList extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pre_entry_id'=>'filled|digits_between:4,18',
            'bill_no'=>'filled|string|between:3,20',
            'container_number'=>'filled|string|between:3,11',

            'per_page'=>'int|between:1,500',

        ];
    }
}
