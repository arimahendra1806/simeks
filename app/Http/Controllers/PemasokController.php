<?php

namespace App\Http\Controllers;

use App\Models\Negara;
use App\Models\Pemasok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PemasokController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Data Pemasok';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Pemasok::with('negara')->orderBy('id', 'desc')->get();

        return view('admin.pemasok.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        $option_negara = Negara::all();

        return view('admin.pemasok.create', compact('title', 'option_negara'));
    }

    private function validation(Request $request, $pemasok = 0)
    {
        $request->validate([
            'negara_id' => 'required',
            'nama' => 'required',
            'email' => 'required|unique:pemasoks,email,' . $pemasok,
            'telepon' => 'required',
            'perusahaan' => 'required',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);

        Pemasok::create($request->all());

        return redirect()->route('admin.pemasok.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasok $pemasok)
    {
        $title = $this->title;
        $option_negara = Negara::all();
        return view('admin.pemasok.show', compact('title', 'pemasok', 'option_negara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasok $pemasok)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemasok $pemasok)
    {
        $this->validation($request, $pemasok->id);

        $pemasok->update($request->all());

        return redirect()->route('admin.pemasok.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasok $pemasok)
    {
        $pemasok->delete();

        return redirect()->route('admin.pemasok.index')->with('success', 'Data berhasil diihapus!');
    }

    public function import()
    {
        $title = $this->title;

        return view('admin.pemasok.import', compact('title'));
    }

    public function import_data(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $importData = Excel::toArray(new Pemasok, $request->file('excel_file'));

        foreach ($importData[0] as $key => $row) {
            if ($key == 0) {
                continue;
            }
            $negara = Negara::where('kode', $row['0'])->first();

            if ($negara) {
                Pemasok::create([
                    'negara_id' => $negara->id,
                    'nama' => $row['1'],
                    'email' => $row['2'],
                    'telepon' => $row['3'],
                    'perusahaan' => $row['4'],
                ]);
            }
        }

        return redirect()->route('admin.pemasok.index')->with('success', 'Data pemasok berhasil diimport!');
    }
}
