<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\Negara;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Data Pembeli';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Pembeli::with('negara')->orderBy('id', 'desc')->get();

        return view('admin.pembeli.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_negara = Negara::all();
        $option_industri = Industri::all();

        return view('admin.pembeli.create', compact('title', 'option_negara', 'option_industri'));
    }

    private function validation(Request $request, $pembeli = 0)
    {
        $request->validate([
            'negara_id' => 'required',
            'industri_id' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:pemasoks,email,' . $pembeli,
            'telepon' => 'required',
            'perusahaan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        // Membuat user baru
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->email),
            'role_id' => 4,
        ]);

        Pembeli::create([
            'user_id' => $user->id,
            'industri_id' => $request->industri_id,
            'negara_id' => $request->negara_id,
            'nama' => $request->nama,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'perusahaan' => $request->perusahaan,
        ]);

        return redirect()->route('admin.pembeli.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembeli $pembeli)
    {
        $title = $this->title;
        $option_negara = Negara::all();
        $option_industri = Industri::all();
        return view('admin.pembeli.show', compact('title', 'pembeli', 'option_negara', 'option_industri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembeli $pembeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        $this->validation($request, $pembeli->id);

        $pembeli->update($request->all());

        return redirect()->route('admin.pembeli.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembeli $pembeli)
    {
        $user = $pembeli->user;
        if ($user) {
            $user->delete();
        }

        $pembeli->delete();

        return redirect()->route('admin.pembeli.index')->with('success', 'Data berhasil diihapus!');
    }
}
