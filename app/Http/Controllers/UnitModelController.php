<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnitModelRequest;
use App\Models\UnitModel;

class UnitModelController extends Controller
{
    public function index()
    {
        $unitModels = UnitModel::orderBy('name')->paginate(15);

        return view('unit-models.index', compact('unitModels'));
    }

    public function create()
    {
        return view('unit-models.create');
    }

    public function store(UnitModelRequest $request)
    {
        UnitModel::create($request->validated());

        return redirect()
            ->route('unit-models.index')
            ->with('success', 'Unit model berhasil ditambahkan.');
    }

    public function edit(UnitModel $unit_model)
    {
        return view('unit-models.edit', [
            'unitModel' => $unit_model,
        ]);
    }

    public function update(
        UnitModelRequest $request,
        UnitModel $unit_model
    ) {
        $unit_model->update($request->validated());

        return redirect()
            ->route('unit-models.index')
            ->with('success', 'Unit model berhasil diperbarui.');
    }

    public function destroy(UnitModel $unit_model)
    {
        if ($unit_model->reports()->exists()) {
            return redirect()
                ->route('unit-models.index')
                ->with(
                    'error',
                    'Unit model tidak dapat dihapus karena masih digunakan oleh laporan.'
                );
        }

        $unit_model->delete();

        return redirect()
            ->route('unit-models.index')
            ->with('success', 'Unit model berhasil dihapus.');
    }
}