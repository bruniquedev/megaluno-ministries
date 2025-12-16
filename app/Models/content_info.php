<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class content_info extends Model
{
    use HasFactory;
       protected $table ='content_info';
public $timestamps = true;
protected $fillable = [
        'title',
        'heading',
        'slug',
        'description',
        'detail_type',
        'link_redirect',
        'filename',
        'file_width',
        'file_height',
        'iconfile',
        'icon_width',
        'icon_height',
        'featured_video',
        'price',
        'day_date',
        'time_of_date',
        'post_views',
        'ratings',
        'email_address',
        'phone_number',
        'status',
        'ispublished', 
        'publisher',
        'sorted_order',
        'page_area_type'
        ];
}
