<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloodGroupRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [];
        if($this->route('id')){
                $rules+=[
                    'name' => 'required|unique:blood_groups,name,'. $this->route('id'),
                ];
        }else{
                $rules+=[
                    'name' => 'required|unique:blood_groups,name',
                ];
        }
        return $rules; 
    }
}
