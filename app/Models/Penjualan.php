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
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class);
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

    public function statusPenjualan()
    {
        return $this->belongsTo(Pilihan::class, 'status', 'parameter')->where('nama', 'status');
    }

    public function setTotalPembelianAttribute($value)
    {
        $this->attributes['total_pembelian'] = str_replace('.', '', $value);
    }

    public function setPpnAttribute($value)
    {
        $this->attributes['ppn'] = str_replace('.', '', $value);
    }

    public function setPphAttribute($value)
    {
        $this->attributes['pph'] = str_replace('.', '', $value);
    }

    public function setDiskonNominalAttribute($value)
    {
        $this->attributes['diskon_nominal'] = str_replace('.', '', $value);
    }

    public function setDiskonPersenAttribute($value)
    {
        $this->attributes['diskon_persen'] = str_replace('.', '', $value);
    }

    public function setBiayaPengirimaanAttribute($value)
    {
        $this->attributes['biaya_pengiriman'] = str_replace('.', '', $value);
    }

    public function setTotalPembayaranAttribute($value)
    {
        $this->attributes['total_pembayaran'] = str_replace('.', '', $value);
    }

    public function setTotalTerbayarAttribute($value)
    {
        $this->attributes['total_terbayar'] = str_replace('.', '', $value);
    }

    public function setSisaPembayaranAttribute($value)
    {
        $this->attributes['sisa_pembayaran'] = str_replace('.', '', $value);
    }
}
