<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class ProdukBySatuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('produk_by_satuans');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class)->withTrashed();
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class)->withTrashed();
    }

    public function setKuantitasAttribute($value)
    {
        $this->attributes['kuantitas'] = str_replace('.', '', $value);
    }

    public function setHargaAttribute($value)
    {
        $this->attributes['harga'] = str_replace('.', '', $value);
    }
}
