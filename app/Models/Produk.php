<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('produks');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function pasar()
    {
        return $this->hasMany(Pasar::class)->withTrashed();
    }

    public function penjualanByProduk()
    {
        return $this->hasMany(PenjualanByProduk::class);
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class)->withTrashed();
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withTrashed();
    }

    public function produkByFoto()
    {
        return $this->hasMany(ProdukByFoto::class)->withTrashed();
    }

    public function produkBySatuan()
    {
        return $this->hasMany(ProdukBySatuan::class)->withTrashed();
    }
}
