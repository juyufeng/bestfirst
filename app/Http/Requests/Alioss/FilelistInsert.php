<?php

namespace App\Http\Requests\Alioss;

use Illuminate\Foundation\Http\FormRequest;

class FilelistInsert extends ObjfileCreate
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
            'bucket'=>'required|string|between:2,20',
            'object'=>'required',
            'localfile'=>'required|file',
            //业务
            'pre_entry_id'=>'required|digits:18',
            'bill_no'=>'string|between:3,20',
            'container_number'=>'string|size:11',
        ];
    }
}
