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

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Site wajib diisi.',
            'name.string' => 'Nama Site harus berupa teks.',
            'name.max' => 'Nama Site maksimal 255 karakter.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
        ];
    }
}