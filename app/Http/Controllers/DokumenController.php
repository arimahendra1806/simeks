<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Dokumen';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Dokumen::all()->sortByDesc('id');

        return view('admin.dokumen.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.dokumen.create', compact('title'));
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

        Dokumen::create($request->all());

        return redirect()->route('admin.dokumen.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dokumen $dokuman)
    {
        $title = $this->title;
        $dokumen = $dokuman;
        return view('admin.dokumen.show', compact('title', 'dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dokumen $dokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dokumen $dokuman)
    {
        $this->validation($request);

        $dokuman->update($request->all());

        return redirect()->route('admin.dokumen.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dokumen $dokuman)
    {
        $dokuman->delete();

        return redirect()->route('admin.dokumen.index')->with('success', 'Data berhasil diihapus!');
    }
}
