<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'Name' => 'required|unique:services,Name->ar,'.$this->id,
            'Name_en' => 'required|unique:services,Name->en,'.$this->id,
            'Description_ar' => 'required|unique:services,Description->ar,'.$this->id,
            'Description_en' => 'required|unique:services,Description->en,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
            'Description_ar.required' => trans('validation.required'),
            'Description_ar.unique' => trans('validation.unique'),
            'Description_en.required' => trans('validation.required'),
            'Description_en.unique' => trans('validation.unique'),
        ];
    }     
}
