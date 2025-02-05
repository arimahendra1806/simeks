<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard_admin()
    {
        $title = 'Dashboard';
        return view('admin.dashboard.index', compact('title'));
    }
}
