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
'contentinfo_id',
'reference',
'amount',
'donationstatus',
'donorname',
'donoremail',
'donorphonenumber',
'addondetails',
'createddate',
'sorted_order',
'status'
 ];
}
