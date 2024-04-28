<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_email',
        'purchase_id',
        'total_price',
        'total_tax',
        'notes',
        'status'
    ];

}
