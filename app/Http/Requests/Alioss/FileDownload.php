<?php

namespace App\Http\Requests\Alioss;

use Illuminate\Foundation\Http\FormRequest;

class FileDownload extends FormRequest
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
            'bucket'=>'string|between:3,30',
            'object'=>'required|string|exists:filelists',
            'timeout'=>'integer|between:300,30000',
        ];
    }
}
