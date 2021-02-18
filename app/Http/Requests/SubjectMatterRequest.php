<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectMatterRequest extends FormRequest
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
            //
            'title' => 'required',
            'details' => 'required',
            'link' => 'required',
            'course' => 'required',
            'path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpeg,png,jpg,mp3,aac'
        ];
    }
}
