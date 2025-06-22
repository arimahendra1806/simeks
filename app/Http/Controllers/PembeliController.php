<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\Negara;
use App\Models\Pembeli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembeliController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Pembeli';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Pembeli::with('negara')->orderBy('id', 'desc')->get();

        return view("admin.pembeli.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_negara = Negara::all();
        $option_industri = Industri::all();

        return view("admin.pembeli.create", compact('title', 'option_negara', 'option_industri'));
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

        DB::beginTransaction();
        try {
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
                'telepon' => normalize_phone_number($request->telepon),
                'perusahaan' => $request->perusahaan,
            ]);

            DB::commit();
            return redirect()->route("$this->prefix.pembeli.index")->with('success', 'Produk berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembeli $pembeli)
    {
        $title = $this->title;
        $option_negara = Negara::all();
        $option_industri = Industri::all();
        return view("admin.pembeli.show", compact('title', 'pembeli', 'option_negara', 'option_industri'));
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

        return redirect()->route("$this->prefix.pembeli.index")->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembeli $pembeli)
    {
        $pembeli->user()->delete();
        $pembeli->delete();

        return redirect()->route("$this->prefix.pembeli.index")->with('success', 'Data berhasil diihapus!');
    }
}
