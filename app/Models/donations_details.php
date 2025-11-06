<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donations_details extends Model
{
    use HasFactory;
    protected $table = 'donations_details';
 public $timestamps = false;
protected $fillable = [
'related_id',
'heading',
'description'
 ];
}
