<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class about_details extends Model
{
    use HasFactory;
     protected $table = 'about_details';
    public $timestamps = false;
protected $fillable = [
'about_id',
'heading',
'description'
 ];
}
