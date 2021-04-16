<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdersModel extends Model
{
    protected $table = 'product_orders';
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_cpf',
        'customer_email',
        'dt_order',
        'bar_code',
        'product_name',
        'unit_price',
        'amount'
    ];
    public $timestamps = false;
}
