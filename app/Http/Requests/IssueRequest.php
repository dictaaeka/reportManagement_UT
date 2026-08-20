<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IssueRequest extends FormRequest
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
                'unique:issues,name,' . $this->route('issue')?->id,
            ],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}

