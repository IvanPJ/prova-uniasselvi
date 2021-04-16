<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomersModel extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf'
    ];
    public $timestamps = false;
}
