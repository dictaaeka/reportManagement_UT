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