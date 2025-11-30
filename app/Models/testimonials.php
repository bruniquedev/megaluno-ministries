<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class testimonials extends Model
{
    use HasFactory;

     protected $table = 'testimonials';
    public $timestamps = false;
protected $fillable = [
'name',
'job_title',
'email',
'reviewdate',
'descriptiontext',
'status',
'ratings'
 ];
}
