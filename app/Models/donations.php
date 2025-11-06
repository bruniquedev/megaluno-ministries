<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donations extends Model
{
    use HasFactory;
        protected $table ='donations';
public $timestamps = false;
protected $fillable = [
'reference',
'amount',
'donationstatus',
'donorname',
'donoremail',
'donorphonenumber',
'addondetails',
'createddate',
'status'
 ];
}
