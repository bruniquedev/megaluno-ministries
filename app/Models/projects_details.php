<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projects_details extends Model
{
    use HasFactory;
    protected $table = 'projects_details';
 public $timestamps = false;
protected $fillable = [
'related_id',
'heading',
'description'
 ];
}
