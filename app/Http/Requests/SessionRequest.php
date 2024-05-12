<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
        return [
            'session' => [
                'required',
                'regex:/^\d{2}-\d{2}$/',
                function($attribute, $value, $fail) {
                    $parts = explode('-', $value);
                    if ($parts[0] + 1 != $parts[1]) {
                        return $fail($attribute.' is not a valid session range.');
                    }
                },
            ],
        ];
    }
}
