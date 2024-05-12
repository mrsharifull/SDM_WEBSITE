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
                    if (!preg_match('/^\d{2}-\d{2}$/', $value)) {
                        return $fail('The '.$attribute.' must be in the format "YY-YY".');
                    }
                    $parts = explode('-', $value);
                    if (count($parts) === 2 && $parts[0] + 1 != $parts[1]) {
                        return $fail('The '.$attribute.' must be a valid session range.');
                    }
                },
            ],
        ];
    }
}
