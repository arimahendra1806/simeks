<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master User';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = User::with('role')->where('role_id', '!=', 4)->orderBy('id', 'desc')->get();

        return view('admin.user.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_role = Role::where('id', '!=', 4)->get();
        return view('admin.user.create', compact('title', 'option_role'));
    }

    private function validation(Request $request, $user = 0)
    {
        $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:255',
            'phone' => 'required|max:15',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user), // Ignore jika update
            ],
            'password' => [
                $user ? 'nullable' : 'required', // Hanya required saat create
                'confirmed',
                'min:8',
            ],
            'password_confirmation' => $request->password ? 'required' : 'nullable', // Required jika password diisi
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        // Ambil hanya data yang diperlukan, lalu hash password
        $data = $request->except('password_confirmation');
        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $title = $this->title;
        $option_role = Role::where('id', '!=', 4)->get();;
        return view('admin.user.show', compact('title', 'user', 'option_role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validation($request, $user->id);

        // Ambil semua data kecuali password_confirmation
        $data = $request->except('password_confirmation');

        // Jika password diisi, hash dan masukkan ke data
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']); // Jangan ubah password jika tidak diisi
        }

        // Update data pengguna
        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'Data berhasil diihapus!');
    }
}
