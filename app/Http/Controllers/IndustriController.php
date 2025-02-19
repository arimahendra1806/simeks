<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use Illuminate\Http\Request;

class IndustriController extends Controller
{
    protected $title;

    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->title = 'Master Industri';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Industri::all()->sortByDesc('id');

        return view('admin.industri.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.industri.create', compact('title'));
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

        Industri::create($request->all());

        return redirect()->route('admin.industri.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Industri $industri)
    {
        $title = $this->title;
        return view('admin.industri.show', compact('title', 'industri'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Industri $industri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Industri $industri)
    {
        $this->validation($request);

        $industri->update($request->all());

        return redirect()->route('admin.industri.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Industri $industri)
    {
        $industri->delete();

        return redirect()->route('admin.industri.index')->with('success', 'Data berhasil diihapus!');
    }
}
