<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules = [];
        if($this->route('id')){
                $rules+=[
                    'name' => 'required|unique:departments,name,'. $this->route('id'),
                ];
        }else{
                $rules+=[
                    'name' => 'required|unique:departments,name',
                ];
        }
        return $rules; 
    }
}
