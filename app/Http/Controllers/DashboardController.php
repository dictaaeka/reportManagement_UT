<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Report;
use App\Models\Site;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'issueCount' => Issue::count(),
            'siteCount' => Site::count(),
            'reportCount' => Report::count(),
            'latestReports' => Report::with(['issue', 'site'])->latest()->limit(5)->get(),
        ]);
    }
}
