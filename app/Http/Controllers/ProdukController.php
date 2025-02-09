<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Pemasok;
use App\Models\Produk;
use App\Models\Provinsi;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Data Produk';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Produk::with('pemasok')->orderBy('id', 'desc')->get();

        return view('admin.produk.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_pemasok = Pemasok::all();
        $option_kategori = Kategori::all();
        $option_provinsi = Provinsi::all();
        $option_kota = Kota::all();
        $option_satuan = Satuan::all();

        return view('admin.produk.create', compact('title', 'option_pemasok', 'option_kategori', 'option_provinsi', 'option_kota', 'option_satuan'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'nama' => 'required',
            'kategori_id' => 'required',
            'satuan_id' => 'required',
            'isi' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Produk::create($request->all());

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $title = $this->title;
        $option_pemasok = Pemasok::all();
        $option_kategori = Kategori::all();
        $option_provinsi = Provinsi::all();
        $option_kota = Kota::where('provinsi_id', $produk->provinsi_id)->get();
        $option_satuan = Satuan::all();

        return view('admin.produk.show', compact('title', 'produk', 'option_pemasok', 'option_kategori', 'option_provinsi', 'option_kota', 'option_satuan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $this->validation($request, $produk->id);

        $produk->update($request->all());

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil diihapus!');
    }

    public function import()
    {
        $title = $this->title;

        return view('admin.produk.import', compact('title'));
    }

    public function import_data(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $importData = Excel::toArray(new Produk, $request->file('excel_file'));

        // foreach ($importData[0] as $key => $row) {
        //     if ($key == 0) {
        //         continue;
        //     }
        //     $negara = Negara::where('kode', $row['0'])->first();

        //     if ($negara) {
        //         Produk::create([
        //             'negara_id' => $negara->id,
        //             'nama' => $row['1'],
        //             'email' => $row['2'],
        //             'telepon' => $row['3'],
        //             'perusahaan' => $row['4'],
        //         ]);
        //     }
        // }

        return redirect()->route('admin.produk.index')->with('success', 'Data produk berhasil diimport!');
    }

    public function get_kota($provinsi)
    {
        $kota = Kota::where('provinsi_id', $provinsi)->get();
        return response()->json($kota);
    }
}
