<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'issue_id' => [
                'required',
                'exists:issues,id',
            ],

            'site_id' => [
                'required',
                'exists:sites,id',
            ],

            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'month' => [
                'required',
                'integer',
                'between:1,12',
            ],

            'year' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'file' => $this->isMethod('post')
                ? ['required', 'file', 'mimes:pdf', 'max:10240']
                : ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'issue_id.required' => 'Issue wajib dipilih.',
            'issue_id.exists' => 'Issue yang dipilih tidak valid.',

            'site_id.required' => 'Site wajib dipilih.',
            'site_id.exists' => 'Site yang dipilih tidak valid.',

            'customer_id.required' => 'Customer wajib dipilih.',
            'customer_id.exists' => 'Customer yang dipilih tidak valid.',

            'month.required' => 'Bulan wajib dipilih.',
            'month.between' => 'Bulan harus antara Januari sampai Desember.',

            'year.required' => 'Tahun wajib diisi.',

            'file.required' => 'File laporan wajib diunggah.',
            'file.mimes' => 'File laporan harus berupa PDF.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}