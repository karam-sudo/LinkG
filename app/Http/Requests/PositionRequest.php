<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            
                'Name_ar' => 'required|unique:positions,Name->ar,'.$this->id,
                'Name_en' => 'required|unique:positions,Name->en,'.$this->id,
                'Description_ar' => 'required',
                'Description_en' => 'required',
                'Service_id'=>'required',
    
            
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
            'Description_en.required' => trans('validation.required'),
            'Service_id.required'=>trans('positions_trans.service_id_required'),
        ];
    }
}
