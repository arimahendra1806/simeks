<?php

namespace App\Http\Controllers;

use App\Models\Industri;
use App\Models\Negara;
use App\Models\Pasar;
use App\Models\Pembeli;
use App\Models\Produk;
use Illuminate\Http\Request;

class PasarController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Pasar';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Pasar::with('industri', 'negara', 'pembeli', 'produk')->orderBy('id', 'desc')->get();

        return view("admin.pasar.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_industri = Industri::all();
        $option_negara = Negara::all();
        $option_pembeli = Pembeli::all();
        $option_produk = Produk::all();

        return view("admin.pasar.create", compact('title', 'option_industri', 'option_negara', 'option_pembeli', 'option_produk'));
    }

    private function validation(Request $request, $pasar = 0)
    {
        $request->validate([
            'industri_id' => 'required',
            'negara_id' => 'required',
            'pembeli_id' => 'required',
            'produk_id' => 'required',
            'regulasi' => 'required',
            'kompetitor' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Pasar::create($request->all());

        return redirect()->route("$this->prefix.pasar.index")->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pasar $pasar)
    {
        // dd($pasar->id);
        $title = $this->title;
        $option_industri = Industri::all();
        $option_negara = Negara::all();
        $option_pembeli = Pembeli::all();
        $option_produk = Produk::all();
        return view("admin.pasar.show", compact('title', 'pasar', 'option_industri', 'option_negara', 'option_pembeli', 'option_produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pasar $pasar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pasar $pasar)
    {
        $this->validation($request, $pasar->id);

        $pasar->update($request->all());

        return redirect()->route("$this->prefix.pasar.index")->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pasar $pasar)
    {
        $pasar->delete();

        return redirect()->route("$this->prefix.pasar.index")->with('success', 'Data berhasil diihapus!');
    }
}
