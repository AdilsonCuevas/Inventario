<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table="categorias";

    protected $fillable = [
        'name_category',
        'status',
    ];
}
