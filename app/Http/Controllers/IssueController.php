<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Models\Issue;
use Illuminate\Http\Request;

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
        Issue::create($request->validated());

        return redirect()->route('issues.index')->with('success', 'Issue berhasil dibuat.');
    }

    public function edit(Issue $issue)
    {
        return view('issues.edit', compact('issue'));
    }

    public function update(IssueRequest $request, Issue $issue)
    {
        $issue->update($request->validated());

        return redirect()->route('issues.index')->with('success', 'Issue berhasil diperbarui.');
    }

    public function destroy(Issue $issue)
    {
        if ($issue->reports()->exists()) {
            return back()->with('error', 'Issue tidak dapat dihapus karena masih digunakan oleh laporan.');
        }

        $issue->delete();

        return redirect()->route('issues.index')->with('success', 'Issue berhasil dihapus.');
    }
}
