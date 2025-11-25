<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class content_details extends Model
{
    use HasFactory;
       protected $table ='content_details';
public $timestamps = true;
protected $fillable = [
    
      'related_id',
      'titlelist',
      'headinglist',
      'sluglist',
      'descriptionlist',        
      'filenamelist',   
      'file_widthlist',
      'file_heightlist',
      'iconfilelist',
      'icon_widthlist',
      'icon_heightlist',
      'video_filelist',
      'link_redirectlist',
      'pricelist',
      'ispublishedlist',
      'ordersort'
      ];
}
