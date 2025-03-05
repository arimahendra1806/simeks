<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kota;
use App\Models\Pemasok;
use App\Models\Produk;
use App\Models\ProdukBySatuan;
use App\Models\Provinsi;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $option_satuan = Satuan::all();

        return view('admin.produk.create', compact('title', 'option_pemasok', 'option_kategori', 'option_satuan'));
    }

    private function validation(Request $request)
    {
        $request->validate([
            'pemasok_id' => 'required',
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required',
            'satuan_id' => 'required|array',
            'kuantitas' => 'required|array',
            'kuantitas.*' => 'numeric|min:1',
            'harga' => 'required|array',
            'harga.*' => 'numeric|min:0',
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
            // Simpan data ke tabel `produk`
            $produk = Produk::create([
                'pemasok_id' => $request->pemasok_id,
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
            ]);

            // Simpan data ke tabel `produk_by_satuans`
            foreach ($request->satuan_id as $index => $satuan_id) {
                ProdukBySatuan::create([
                    'produk_id' => $produk->id,
                    'satuan_id' => $satuan_id,
                    'kuantitas' => $request->kuantitas[$index],
                    'harga' => $request->harga[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

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
        $option_satuan = Satuan::all();

        $hargas = ProdukBySatuan::with('satuan', 'produk')->where('produk_id', $produk->id)->get();

        return view('admin.produk.show', compact('title', 'produk', 'option_pemasok', 'option_kategori', 'option_satuan', 'hargas'));
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
        DB::beginTransaction();
        try {
            // Simpan data ke tabel `produk`
            $produk->update([
                'pemasok_id' => $request->pemasok_id,
                'nama' => $request->nama,
                'kategori_id' => $request->kategori_id,
                'deskripsi' => $request->deskripsi,
            ]);

            $produk->produkBySatuan()->delete();
            // Simpan data ke tabel `produk_by_satuans`
            foreach ($request->satuan_id as $index => $satuan_id) {
                ProdukBySatuan::create([
                    'produk_id' => $produk->id,
                    'satuan_id' => $satuan_id,
                    'kuantitas' => $request->kuantitas[$index],
                    'harga' => $request->harga[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('admin.produk.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $produk->produkBySatuan()->delete();
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
}
