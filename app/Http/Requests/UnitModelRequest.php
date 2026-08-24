<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UnitModelRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $unitModelId = $this->route('unit_model')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('unit_models', 'name')->ignore($unitModelId),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama unit model wajib diisi.',
            'name.unique' => 'Nama unit model ini sudah ada.',
        ];
    }
}