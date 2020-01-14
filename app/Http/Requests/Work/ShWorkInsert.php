<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class ShWorkInsert extends FormRequest
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
            'pre_entry_id'=>'required|unique:sh_work_nos|digits:18',
            'bill_no'=>'string|between:3,20',
            'container_number'=>'string|size:11',
        ];
    }
}
