<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class areasserved extends Model
{
    use HasFactory;
        protected $table = 'areasserved';
public $timestamps = false;
protected $fillable = [
'headingtext',
'descriptiontext',
'areamapcode'
];
}
