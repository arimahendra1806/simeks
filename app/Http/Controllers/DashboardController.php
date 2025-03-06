<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $title = 'Dashboard Admin';
        return view('admin.dashboard.index', compact('title'));
    }

    public function dashboard_direktur()
    {
        $title = 'Dashboard Direktur';
        return view('direktur.dashboard.index', compact('title'));
    }

    public function dashboard_marketing()
    {
        $title = 'Dashboard Marketing';
        return view('marketing.dashboard.index', compact('title'));
    }
}
