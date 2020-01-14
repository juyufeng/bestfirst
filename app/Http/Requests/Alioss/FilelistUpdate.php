<?php

namespace App\Http\Requests\Alioss;

use Illuminate\Foundation\Http\FormRequest;

class FilelistUpdate extends ObjfileCreate
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
            'id'=>'filled|integer|exists:filelists',
            'pre_entry_id'=>'filled|integer|digits:18|unique:filelists',
            'bill_no'=>'filled|string|between:3,20',

            //如果有object,就必须必填,满足ObjfileCreate的规则
            'object'=>'filled',
            'bucket'=>'required_with:object|string|between:2,30',
            'localfile'=>'required_with:object|file',
        ];
    }
}
