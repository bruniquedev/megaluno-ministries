<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activities_details extends Model
{
    use HasFactory;
    protected $table = 'activities_details';
 public $timestamps = false;
protected $fillable = [
'related_id',
'heading',
'description'
 ];
}
