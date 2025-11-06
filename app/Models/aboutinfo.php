<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aboutinfo extends Model
{
    use HasFactory;

     protected $table = 'aboutinfo';
    public $timestamps = false;
protected $fillable = [
'headingtext',
'filename',
'widthsize',
'heightsize'
 ];
}
