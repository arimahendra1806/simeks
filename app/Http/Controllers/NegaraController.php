<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use Illuminate\Http\Request;

class NegaraController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Negara';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Negara::all()->sortByDesc('id');

        return view('admin.negara.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.negara.create', compact('title'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'kode' => 'required|max:3',
            'nama' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Negara::create($request->all());

        return redirect()->route('admin.negara.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Negara $negara)
    {
        $title = $this->title;
        return view('admin.negara.show', compact('title', 'negara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Negara $negara)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Negara $negara)
    {
        $this->validation($request);

        $negara->update($request->all());

        return redirect()->route('admin.negara.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Negara $negara)
    {
        $negara->delete();

        return redirect()->route('admin.negara.index')->with('success', 'Data berhasil diihapus!');
    }
}
