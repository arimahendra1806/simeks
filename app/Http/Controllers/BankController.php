<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    protected $title;

    public function __construct()
    {
        $this->title = 'Master Bank';
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = $this->title;
        $data = Bank::all()->sortByDesc('id');

        return view('admin.bank.index', compact('title', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = $this->title;
        return view('admin.bank.create', compact('title'));
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

        Bank::create($request->all());

        return redirect()->route('admin.bank.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bank $bank)
    {
        $title = $this->title;
        return view('admin.bank.show', compact('title', 'bank'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bank $bank)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validation($request);

        $bank->update($request->all());

        return redirect()->route('admin.bank.index')->with('success', 'Data berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();

        return redirect()->route('admin.bank.index')->with('success', 'Data berhasil diihapus!');
    }
}
