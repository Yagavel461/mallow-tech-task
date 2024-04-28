<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_email',
        'purchase_id',
        'product_id',
        'quantity',
        'total_price',
        'unit_price',
        'total_tax',
    ];
}
