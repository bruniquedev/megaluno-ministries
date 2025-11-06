<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class servicesinfo extends Model
{
    use HasFactory;

     protected $table = 'servicesinfo';
    public $timestamps = false;
protected $fillable = [
'name',
'heading',
'filename',
'widthsize',
'heightsize'
 ];
}
