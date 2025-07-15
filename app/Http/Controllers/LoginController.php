<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private function validation(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    public function admin_login()
    {
        $title = 'Login';
        return view('admin.login.index', compact('title'));
    }

    public function do_log_admin(Request $request)
    {
        $this->validation($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 1])) {
            $request->session()->regenerate();

            session(['user_name' => Auth::user()->name]);
            session(['role_id' => Auth::user()->role_id]);
            session()->flash('success', 'Login berhasil!');

            return redirect()->route('admin.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function marketing_login()
    {
        $title = 'Login';
        return view('marketing.login.index', compact('title'));
    }

    public function do_log_marketing(Request $request)
    {
        $this->validation($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 2])) {
            $request->session()->regenerate();

            session(['user_name' => Auth::user()->name]);
            session(['role_id' => Auth::user()->role_id]);
            session()->flash('success', 'Login berhasil!');

            return redirect()->route('marketing.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function direktur_login()
    {
        $title = 'Login';
        return view('direktur.login.index', compact('title'));
    }

    public function do_log_direktur(Request $request)
    {
        $this->validation($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 3])) {
            $request->session()->regenerate();

            session(['user_name' => Auth::user()->name]);
            session(['role_id' => Auth::user()->role_id]);
            session()->flash('success', 'Login berhasil!');

            return redirect()->route('direktur.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function buyer_login()
    {
        $title = 'Login';
        return view('buyer.login.index', compact('title'));
    }

    public function do_log_buyer(Request $request)
    {
        $this->validation($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 4])) {
            $request->session()->regenerate();

            session(['user_name' => Auth::user()->name]);
            session(['role_id' => Auth::user()->role_id]);
            session()->flash('success', 'Login berhasil!');

            return redirect()->route('buyer.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function supplier_login()
    {
        $title = 'Login';
        return view('supplier.login.index', compact('title'));
    }

    public function do_log_supplier(Request $request)
    {
        $this->validation($request);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role_id' => 5])) {
            $request->session()->regenerate();

            $data_pemasok = Pemasok::where('users_id', Auth::user()->id)->first();

            if (!$data_pemasok) {
                return back()->with([
                    'error' => 'Username atau Password anda salah'
                ]);
            }

            session(['user_name' => Auth::user()->name]);
            session(['role_id' => Auth::user()->role_id]);
            session(['pemasok_id' => $data_pemasok->id]);
            session()->flash('success', 'Login berhasil!');

            return redirect()->route('supplier.dashboard.index');
        }

        return back()->with([
            'error' => 'Username atau Password anda salah'
        ]);
    }

    public function logout(Request $request)
    {
        $logout_url = $this->url_logout(Auth::user()->role_id);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route($logout_url);
    }

    private function url_logout($role_id)
    {
        switch ($role_id) {
            case 1:
                return 'admin_login';
            case 2:
                return 'marketing_login';
            case 3:
                return 'direktur_login';
            case 4:
                return 'buyer_login';
            case 5:
                return 'supplier_login';
        }

        return '/';
    }
}
