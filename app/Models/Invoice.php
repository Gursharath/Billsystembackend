<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_name', 'total', 'created_by'];

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}