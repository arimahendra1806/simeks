<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class PenjualanByPengiriman extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'penjualan_by_pengirimans';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('penjualan_by_pengirimans');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function statusPengiriman()
    {
        return $this->belongsTo(Pilihan::class, 'status_pengiriman', 'parameter')->where('nama', 'status_pengiriman');
    }
}
