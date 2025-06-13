<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class PenjualanByPengirimanDarurat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];
    protected $table = 'penjualan_by_pengirimans_darurat';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('penjualan_by_pengirimans_darurat');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function pengiriman()
    {
        return $this->belongsTo(PenjualanByPengiriman::class, 'pengiriman_id', 'id')->withTrashed();
    }
}
