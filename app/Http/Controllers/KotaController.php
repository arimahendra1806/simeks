<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Kota';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Kota::with('provinsi')->orderBy('id', 'desc')->get();

        return view('admin.kota.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_provinsi = Provinsi::all();
        return view('admin.kota.create', compact('title', 'option_provinsi'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'provinsi_id' => 'required',
            'nama' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Kota::create($request->all());

        return redirect()->route('admin.kota.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kota $kotum)
    {
        $title = $this->title;
        $option_provinsi = Provinsi::all();
        return view('admin.kota.show', compact('title', 'kotum', 'option_provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kota $kota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kota $kotum)
    {
        $this->validation($request);

        $kotum->update($request->all());

        return redirect()->route('admin.kota.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kota $kotum)
    {
        $kotum->delete();

        return redirect()->route('admin.kota.index')->with('success', 'Data berhasil diihapus!');
    }
}
