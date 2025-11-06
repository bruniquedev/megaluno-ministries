<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
     protected $table = 'messages';
    public $timestamps = false;
protected $fillable = [
'sendername',
'sendermail',
'phonenumber',
'subject',
'messagetext',
'messagedate',
'seenstatus'
 ];
}
