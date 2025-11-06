<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class totalview extends Model
{
    use HasFactory;

    protected $table = 'totalview';
    public $timestamps = false;
     protected $fillable = [
        'page',
        'totalvisit'
    ];

}
