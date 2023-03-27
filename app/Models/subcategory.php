<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategory extends Model
{
    protected $table="subcategorias";

    protected $fillable = [
        'name_subcategory',
        'status',
        'category',
        'Npruducts',
    ];
}
