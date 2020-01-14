<?php

namespace App\Http\Requests\Work;

use Illuminate\Foundation\Http\FormRequest;

class ShWorkFindOne extends FormRequest
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
            'id'=>'filled|integer|exists:sh_work_nos',
            'pre_entry_id'=>'filled|integer|digits:18|exists:sh_work_nos',
            'bill_no'=>'filled|exists:sh_work_nos|string|between:3,20',
        ];
    }
}
