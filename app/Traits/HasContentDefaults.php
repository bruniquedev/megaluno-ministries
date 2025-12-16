<?php

namespace App\Traits;

trait HasContentDefaults
{
    public static function defaultContent()
    {
        return [
            'id' => 0,
            'title' => '',
            'description' => '',
            'heading' => '',
            'detail_type'=> '',
            'link_redirect' => '',
            'publisher' => '',
            'day_date' => '',
            'slug' => '',
            'featured_video' => '',
            'price' => 0,
            'time_of_date' => '',
            'post_views' => '',
            'ratings' => 0,
            'email_address' => '',
            'phone_number' => '',
            'status' => 0,
            'ispublished' => 1,
            'page_area_type' => '',
            'filename' => '',
            'file_width' => '600',
            'file_height' => '350',
            'iconfile' => '',
            'icon_width' => '100',
            'icon_height' => '100',
        ];
    }

    public static function defaultDetailItems()
    {
        return [];
    }
}
