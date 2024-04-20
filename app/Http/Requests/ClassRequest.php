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
        return [
            'name' => 'required',
        ]+
        ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    protected function store(): array
    {
        return [
            'class_number' => 'required|numeric|unique:classes,class_number',
        ];
    }

    protected function update(): array
    {
        return [
            'class_number' => 'required|numeric|unique:classes,class_number,'. $this->route('id'),
        ];
    }
}
