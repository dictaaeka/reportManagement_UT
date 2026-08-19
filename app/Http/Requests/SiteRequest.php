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