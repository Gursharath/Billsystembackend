<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'barcode', 'price', 'quantity', 'image_path'];

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }
}