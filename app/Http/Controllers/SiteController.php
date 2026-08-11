<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::orderBy('name')->paginate(15);

        return view('sites.index', compact('sites'));
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(SiteRequest $request)
    {
        Site::create($request->validated());

        return redirect()->route('sites.index')->with('success', 'Site berhasil dibuat.');
    }

    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->validated());

        return redirect()->route('sites.index')->with('success', 'Site berhasil diperbarui.');
    }

    public function destroy(Site $site)
    {
        if (Auth::user()?->role !== 'admin') {
            abort(403);
        }

        if ($site->reports()->exists()) {
            return back()->with('error', 'Site tidak dapat dihapus karena masih digunakan oleh laporan.');
        }

        $site->delete();

        return redirect()->route('sites.index')->with('success', 'Site berhasil dihapus.');
    }
}