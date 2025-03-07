<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class Pembeli extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $columns = Schema::getColumnListing('pembelis');
        $columns = array_filter($columns, function ($column) {
            return $column != 'id' && !in_array($column, ['created_at', 'updated_at', 'deleted_at']);
        });
        $this->fillable = array_values($columns);
    }

    public function pasar()
    {
        return $this->hasMany(Pasar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function negara()
    {
        return $this->belongsTo(Negara::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }
}
