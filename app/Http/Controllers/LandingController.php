<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $title = 'SIPA';

        $categories = Kategori::all();
        $products = Produk::with('kategori', 'produkByFoto', 'produkBySatuan')->get();

        return view('landing.index', compact('title', 'categories', 'products'));
    }
}
