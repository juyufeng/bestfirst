<?php

namespace App\Http\Requests\Alioss;

use Illuminate\Foundation\Http\FormRequest;

class FilelistFindOne extends FormRequest
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
            'pre_entry_id'=>'filled|integer|digits:18|exists:filelists',
            'bill_no'=>'filled|exists:filelists|string|between:3,20',
            'bucket'=>'filled|required_with:object|exists:filelists|string|between:3,20',
            'object'=>'filled|required_with:bucket|exists:filelists',
        ];


    }
}
