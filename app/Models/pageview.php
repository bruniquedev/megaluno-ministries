<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pageview extends Model
{
    use HasFactory;

    protected $table = 'pageview';
    public $timestamps = false;
 protected $fillable = [
'page',
'userip',
'country',
'city',
'countrycode',
'latitude',
'longitude',
'sorted_order',
'visitdate'
 ];

}
