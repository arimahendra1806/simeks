<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class PenjualanByBayar extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('penjualan_by_bayars');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class)->withTrashed();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class)->withTrashed();
    }

    public function statusKategori()
    {
        return $this->belongsTo(Pilihan::class, 'kategori_pembayaran', 'parameter')->where('nama', 'kategori_pembayaran')->withTrashed();
    }

    public function tipe()
    {
        return $this->belongsTo(Pilihan::class, 'tipe_pembayaran', 'parameter')->where('nama', 'tipe_pembayaran')->withTrashed();
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class)->withTrashed();
    }
}
