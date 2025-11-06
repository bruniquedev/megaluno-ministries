<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service_details extends Model
{
    use HasFactory;

     protected $table = 'service_details';
    public $timestamps = false;
protected $fillable = [
'service_id',
'heading',
'description'
 ];
}
