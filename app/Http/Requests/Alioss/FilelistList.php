<?php

namespace App\Http\Requests\Alioss;

use Illuminate\Foundation\Http\FormRequest;

class FilelistList extends FormRequest
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
            'pre_entry_id'=>'filled|integer|between:4,18',
            'bill_no'=>'filled|string|between:3,20',
            'container_number'=>'filled|string|between:3,11',
            //如果有object,就必须必填,满足ObjfileCreate的规则
            'object'=>'filled',
            'bucket'=>'required_with:object|string|between:2,30',

            'istoSql'=>'filled|boolean',
            'per_page'=>'int|between:1,500'
        ];
    }
}
