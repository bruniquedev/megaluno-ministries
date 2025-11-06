<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectsinfo extends Model
{
    use HasFactory;
     protected $table = 'projectsinfo';
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
