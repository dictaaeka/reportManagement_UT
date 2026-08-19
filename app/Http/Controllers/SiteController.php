<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteRequest;
use App\Models\Site;
use App\Models\User;
use App\Notifications\SystemNotification;
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
        $site = Site::create($request->validated());

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'add_site',
                    Auth::user()->name . ' menambahkan site',
                    $site->name
                )
            );
        }

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site berhasil ditambahkan.');
    }

    public function edit(Site $site)
    {
        return view('sites.edit', compact('site'));
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update($request->validated());

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'edit_site',
                    Auth::user()->name . ' mengedit site',
                    $site->name
                )
            );
        }

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site berhasil diperbarui.');
    }

    public function destroy(Site $site)
    {
        $siteName = $site->name;

        $site->delete();

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'delete_site',
                    Auth::user()->name . ' menghapus site',
                    $siteName
                )
            );
        }

        return redirect()
            ->route('sites.index')
            ->with('success', 'Site berhasil dihapus.');
    }
}