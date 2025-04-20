<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Penjualan;
use App\Models\PenjualanByDokumen;
use App\Models\PenjualanByRiwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenjualanByDokumenController extends Controller
{
    protected $title;
    protected $prefix;

    public function __construct()
    {
        $this->title = 'Data Dokumen Penjualan';
        $this->prefix = request()->segment(1);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Penjualan::with('pembeli', 'statusPenjualan')->where('status', '>', 1)->orderBy('id', 'desc')->get();

        return view("admin.penjualan_dokumen.index", compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    private function validation(Request $request)
    {
        $request->validate([
            'dokumen_id' => 'required',
            'file' => 'required|file|mimes:pdf',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $title = $this->title;
        $option_dokumen = Dokumen::all();
        $penjualan = Penjualan::where('id', $id)->first();
        $dokumens = PenjualanByDokumen::with('dokumen')->where('penjualan_id', $id)->get();

        return view("admin.penjualan_dokumen.show", compact('title', 'penjualan', 'option_dokumen', 'dokumens'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PenjualanByDokumenController $PenjualanByDokumenController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validation($request);

        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = time() . '-' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/uploads/dokumen'), $filename);

                PenjualanByDokumen::create([
                    'penjualan_id' => $id,
                    'dokumen_id' => $request->dokumen_id,
                    'file' => $filename,
                ]);
            }

            DB::commit();
            return back()->with('success', 'Dokumen berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        PenjualanByDokumen::where('id', $id)->delete();

        return back()->with('success', 'Data berhasil diihapus!');
    }

    public function konfirmasi($id)
    {
        DB::beginTransaction();
        try {
            Penjualan::where('id', $id)->update([
                'status' => 3,
            ]);

            PenjualanByRiwayat::create([
                'references_id' => $id,
                'penjualan_id' => 0,
                'tipe' => 1,
                'status' => 3,
                'tanggal' => date('Y-m-d'),
            ]);

            DB::commit();
            return back()->with('success', 'Dokumen penjualan berhasil dikonfirmasi!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
