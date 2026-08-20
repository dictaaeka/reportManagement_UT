<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:sites,name,' . $this->route('site')?->id,
            ],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama site wajib diisi.',
            'name.unique' => 'Nama site sudah digunakan.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
        ];
    }
}