<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()?->role === 'admin';
    }

    public function rules(): array
    {
        $rules = [
            'issue_id' => ['required', 'exists:issues,id'],
            'site_id' => ['required', 'exists:sites,id'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'between:1900,' . date('Y')],
            'title' => ['required', 'string', 'max:255'],
        ];

        if ($this->isMethod('post')) {
            $rules['file'] = ['required', 'file', 'mimes:pdf', 'max:10240'];
        } else {
            $rules['file'] = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        return $rules;
    }
}
