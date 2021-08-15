<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'Name_ar' => 'required',
            'Name_en' => 'required',
            'Email' => 'required|email|unique:team_members,email,'.$this->id,
            'gender_id' => 'required',
            'Phone' => 'required',
            'jobtime_id' => 'required',
            'jobtype_id' => 'required',
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            'service_id' => 'required',
            
            'position_id' => 'required',
            'currency_id' => 'required',
            'salary' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
            'Email.required' => trans('validation.required'),
            'Email.unique' => trans('validation.unique'),
            'gender_id.required' => trans('validation.required'),
            'jobtime_id.required' => trans('validation.required'),
            'jobtype_id.required' => trans('validation.required'),
            'service_id.required' => trans('validation.required'),
            'position_id.required' => trans('validation.required'),
            'currency_id.required' => trans('validation.required'),
            'salary.required' => trans('validation.required'),
        ];
    }     
}
