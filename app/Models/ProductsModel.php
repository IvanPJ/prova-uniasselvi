<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'bar_code',
        'unit_price'
    ];
    public $timestamps = false;

}
