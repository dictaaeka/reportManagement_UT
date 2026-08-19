<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use App\Models\User;
use App\Notifications\SystemNotification;
use Illuminate\Support\Facades\Auth;

class IssueController extends Controller
{
    public function index()
    {
        $issues = Issue::orderBy('name')->paginate(15);

        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        return view('issues.create');
    }

    public function store(IssueRequest $request)
    {
        $issue = Issue::create($request->validated());

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'add_issue',
                    Auth::user()->name . ' menambahkan issue',
                    $issue->name
                )
            );
        }

        return redirect()
            ->route('issues.index')
            ->with('success', 'Issue berhasil ditambahkan.');
    }

    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }

    public function update(IssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'edit_issue',
                    Auth::user()->name . ' mengedit issue',
                    $issue->name
                )
            );
        }

        return redirect()
            ->route('issues.index')
            ->with('success', 'Issue berhasil diperbarui.');
    }

    public function destroy(Issue $issue)
    {
        $issueName = $issue->name;

        $issue->delete();

        // NOTIFICATION UNTUK SEMUA ADMIN
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'delete_issue',
                    Auth::user()->name . ' menghapus issue',
                    $issueName
                )
            );
        }

        return redirect()
            ->route('issues.index')
            ->with('success', 'Issue berhasil dihapus.');
    }
}