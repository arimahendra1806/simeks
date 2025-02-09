<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Satuan';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Satuan::all()->sortByDesc('id');

        return view('admin.satuan.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.satuan.create', compact('title'));
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

        Satuan::create($request->all());

        return redirect()->route('admin.satuan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Satuan $satuan)
    {
        $title = $this->title;
        return view('admin.satuan.show', compact('title', 'satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Satuan $satuan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Satuan $satuan)
    {
        $this->validation($request);

        $satuan->update($request->all());

        return redirect()->route('admin.satuan.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Satuan $satuan)
    {
        $satuan->delete();

        return redirect()->route('admin.satuan.index')->with('success', 'Data berhasil diihapus!');
    }
}
