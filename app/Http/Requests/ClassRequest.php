<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassRequest extends FormRequest
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
                    'name' => 'required|unique:classes,name,'. $this->route('id'),
                    'class_number' => 'required|numeric|unique:classes,class_number,'. $this->route('id'),
                ];
        }else{
                $rules+=[
                    'name' => 'required|unique:classes,name',
                    'class_number' => 'required|numeric|unique:classes,class_number',
                ];
        }
        return $rules; 
    }
}
