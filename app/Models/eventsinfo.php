<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class eventsinfo extends Model
{
    use HasFactory;
     protected $table = 'eventsinfo';
  public $timestamps = false;
protected $fillable = [
'headingtext',
'descriptiontext',
'filename',
'widthsize',
'heightsize',
'status'
 ];
}
