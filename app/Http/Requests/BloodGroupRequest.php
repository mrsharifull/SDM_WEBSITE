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
        return [
            
        ]+
        ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store(): array
    {
        return [
            'name' => 'required|unique:blood_groups,name',
        ];
    }

    protected function update(): array
    {
        return [
            'name' => 'required|unique:blood_groups,name,'. $this->route('id'),
        ];
    }
}
