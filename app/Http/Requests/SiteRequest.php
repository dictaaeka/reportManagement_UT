<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()?->role === 'admin';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }
}
