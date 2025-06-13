<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class PenjualanByRiwayat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('penjualan_by_riwayats');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'references_id', 'id')->withTrashed();
    }

    public function pengiriman()
    {
        return $this->belongsTo(PenjualanByPengiriman::class, 'references_id', 'id')->withTrashed();
    }

    public function bayar()
    {
        return $this->belongsTo(PenjualanByBayar::class, 'references_id', 'id')->withTrashed();
    }

    public function status_penjualan()
    {
        return Pilihan::where('nama', 'status')
            ->where('parameter', $this->status)
            ->first();
    }

    public function status_pengiriman()
    {
        return Pilihan::where('nama', 'status_pengiriman')
            ->where('parameter', $this->status)
            ->first();
    }
}
