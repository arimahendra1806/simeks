<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Penjualan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('penjualans');
        $columns = array_filter($columns, function ($column) {
            return !str_contains($column, 'id') && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function penjualanByBayar()
    {
        return $this->hasMany(PenjualanByBayar::class);
    }

    public function penjualanByDokumen()
    {
        return $this->hasMany(PenjualanByDokumen::class);
    }

    public function penjualanByPengembalian()
    {
        return $this->hasMany(PenjualanByPengembalian::class);
    }

    public function penjualanByPengiriman()
    {
        return $this->hasMany(PenjualanByPengiriman::class);
    }

    public function penjualanByProduk()
    {
        return $this->hasMany(PenjualanByProduk::class);
    }

    public function penjualanByRiwayat()
    {
        return $this->hasMany(PenjualanByRiwayat::class);
    }
}
