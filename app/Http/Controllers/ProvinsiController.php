<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Provinsi';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Provinsi::all()->sortByDesc('id');

        return view('admin.provinsi.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.provinsi.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Provinsi::create($request->all());

        return redirect()->route('admin.provinsi.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provinsi $provinsi)
    {
        $title = $this->title;
        return view('admin.provinsi.show', compact('title', 'provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provinsi $provinsi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provinsi $provinsi)
    {
        $this->validation($request);

        $provinsi->update($request->all());

        return redirect()->route('admin.provinsi.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provinsi $provinsi)
    {
        $provinsi->delete();

        return redirect()->route('admin.provinsi.index')->with('success', 'Data berhasil diihapus!');
    }
}
