<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    

    public function rules(): array
    {

        $rules = [
            'name' => 'required|min:4',
            'role'=>'required|exists:roles,id'
            
        ];

        if($this->route('id')){
                $rules+=[
                    'email' => 'required|unique:admins,email,' . $this->route('id'),
                    'password' => 'nullable|min:6|confirmed',
                ];
        }else{
                $rules+=[
                    'email' => 'required|unique:admins,email',
                    'password' => 'required|min:6|confirmed',
                ];
            
        }
        return $rules;  
    }
}
