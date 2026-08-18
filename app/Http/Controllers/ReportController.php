<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Customer;
use App\Models\Issue;
use App\Models\Report;
use App\Models\Site;
use App\Models\User;
use App\Notifications\SystemNotification;
use App\Services\PdfCompressorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $issues = Issue::orderBy('name')->get();
        $sites = Site::orderBy('name')->get();
        $customers = Customer::orderBy('name')->get();

        $query = Report::with(['issue', 'site', 'customer', 'uploader']);

        if ($request->filled('issue')) {
            $query->where('issue_id', $request->issue);
        }

        if ($request->filled('site')) {
            $query->where('site_id', $request->site);
        }

        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('search')) {
            $keyword = $request->search;

            $query->where(function ($sub) use ($keyword) {
                $sub->where('file_name', 'like', "%{$keyword}%")
                    ->orWhereHas('customer', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('issue', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    })
                    ->orWhereHas('site', function ($q) use ($keyword) {
                        $q->where('name', 'like', "%{$keyword}%");
                    });
            });
        }

        $reports = $query->latest()->paginate(12);

        /** @var \Illuminate\Pagination\LengthAwarePaginator $reports */
        $reports->withQueryString();

        return view('reports.index', [
            'reports' => $reports,
            'issues' => $issues,
            'sites' => $sites,
            'customers' => $customers,
            'issueCount' => Issue::count(),
            'siteCount' => Site::count(),
            'reportCount' => Report::count(),
            'latestReports' => Report::with([
                'issue',
                'site',
                'customer',
            ])->latest()->limit(5)->get(),
        ]);
    }

    public function create()
    {
        return view('reports.create', [
            'issues' => Issue::orderBy('name')->get(),
            'sites' => Site::orderBy('name')->get(),
            'customers' => Customer::orderBy('name')->get(),
        ]);
    }

    /**
     * Tambah laporan baru
     */
    public function store(ReportRequest $request)
    {
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();

        $pathPrefix = 'reports';

        $storedName = now()->timestamp . '_'
            . Str::slug(pathinfo($originalName, PATHINFO_FILENAME))
            . '.'
            . $file->extension();

        $path = $file->storeAs(
            'reports',
            $storedName,
            'public'
        );

        // Kompres PDF supaya lebih hemat space (aman kalau Ghostscript belum ada).
        $absolutePath = Storage::disk('public')->path($path);
        (new PdfCompressorService())->compress($absolutePath);
        $finalSize = filesize($absolutePath);

        $report = Report::create([
            'issue_id' => $request->issue_id,
            'site_id' => $request->site_id,
            'customer_id' => $request->customer_id,
            'month' => $request->month,
            'year' => $request->year,
            'file_name' => $originalName,
            'file_path' => $path,
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $finalSize,
            'uploader_id' => Auth::id(),
        ]);


        /*
         * NOTIFICATION UNTUK USER BIASA
         * Semua user dengan role "user" mendapat pemberitahuan
         * bahwa ada laporan baru yang tersedia.
         */
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $user->notify(
                new SystemNotification(
                    'new_report_available',
                    'Laporan baru tersedia',
                    $report->customer?->name ?? '-'
                )
            );
        }

        /*
         * ACTIVITY NOTIFICATION UNTUK ADMIN
         * Administrator mendapat informasi bahwa ada user
         * yang menambahkan laporan.
         */
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'add_report',
                    Auth::user()->name . ' menambahkan laporan',
                    $report->customer?->name ?? '-'
                )
            );
        }

        return redirect()
            ->route('reports.index')
            ->with('success', 'Laporan berhasil diunggah.');
    }

    public function show(Report $report)
    {
        $report->load([
            'issue',
            'site',
            'customer',
            'uploader',
        ]);

        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        if (Auth::id() !== $report->uploader_id && Auth::user()?->role !== 'admin') {
            abort(403);
        }

        $report->load([
            'issue',
            'site',
            'customer',
        ]);

        return view('reports.edit', [
            'report' => $report,
            'issues' => Issue::orderBy('name')->get(),
            'sites' => Site::orderBy('name')->get(),
            'customers' => Customer::orderBy('name')->get(),
        ]);
    }

    /**
     * Edit laporan
     */
    public function update(ReportRequest $request, Report $report)
    {
        if (Auth::id() !== $report->uploader_id && Auth::user()?->role !== 'admin') {
            abort(403);
        }
        
        $report->issue_id = $request->issue_id;
        $report->site_id = $request->site_id;
        $report->month = $request->month;
        $report->year = $request->year;
        $report->customer_id = $request->customer_id;

        if ($request->hasFile('file')) {
            if (
                $report->file_path &&
                Storage::disk('public')->exists($report->file_path)
            ) {
                Storage::disk('public')->delete($report->file_path);
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();

            $storedName = now()->timestamp . '_'
                . Str::slug(pathinfo($originalName, PATHINFO_FILENAME))
                . '.'
                . $file->extension();

            $path = $file->storeAs(
                'reports',
                $storedName,
                'public'
            );

            // Kompres PDF supaya lebih hemat space (aman kalau Ghostscript belum ada).
            $absolutePath = Storage::disk('public')->path($path);
            (new PdfCompressorService())->compress($absolutePath);

            $report->file_name = $originalName;
            $report->file_path = $path;
            $report->mime_type = $file->getClientMimeType();
            $report->file_size = filesize($absolutePath);
        }

        $report->save();

        /*
         * NOTIFICATION UNTUK USER BIASA
         * Memberitahu bahwa laporan telah diperbarui.
         */
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $user->notify(
                new SystemNotification(
                    'report_updated',
                    'Laporan diperbarui',
                    $report->customer?->name ?? '-'
                )
            );
        }

        /*
         * ACTIVITY NOTIFICATION UNTUK ADMIN
         */
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'edit_report',
                    Auth::user()->name . ' mengedit laporan',
                    $report->customer?->name ?? '-'
                )
            );
        }

        return redirect()
            ->route('reports.index')
            ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Hapus laporan
     */
    public function destroy(Report $report)
    {
        if (Auth::id() !== $report->uploader_id && Auth::user()?->role !== 'admin') {
            abort(403);
        }

        $customerName = $report->customer?->name ?? '-';

        $disk = Storage::disk('public');

        if (
            $report->file_path &&
            $disk->exists($report->file_path)
        ) {
            $disk->delete($report->file_path);
        }

        $report->delete();

        /*
         * NOTIFICATION UNTUK USER BIASA
         * Memberitahu bahwa laporan sudah dihapus.
         */
        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $user->notify(
                new SystemNotification(
                    'report_deleted',
                    'Laporan telah dihapus',
                    $customerName
                )
            );
        }

        /*
         * ACTIVITY NOTIFICATION UNTUK ADMIN
         */
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new SystemNotification(
                    'delete_report',
                    Auth::user()->name . ' menghapus laporan',
                    $customerName
                )
            );
        }

        return redirect()
            ->route('reports.index')
            ->with('success', 'Laporan berhasil dihapus.');
    }

    public function preview(Report $report)
    {
        $path = storage_path('app/public/' . $report->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function download(Report $report)
    {
        $path = storage_path('app/public/' . $report->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        // NOTIFICATION UNTUK USER YANG MELAKUKAN DOWNLOAD
        Auth::user()->notify(
            new SystemNotification(
                'download_report',
                'Laporan diunduh',
                $report->customer?->name ?? '-'
            )
        );

        return response()->download(
            $path,
            $report->file_name
        );
    }
}
