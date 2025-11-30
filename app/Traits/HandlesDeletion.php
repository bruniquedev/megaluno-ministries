<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
use App\Models\content_info;
use App\Models\content_details;
trait HandlesDeletion
{
    public function deleteById(string $table, $id)
    {
       // return DB::table($table)->where('id', $id)->delete();

             $data = content_info::find($id);
           if($data->filename != ''){
            Storage::delete('public/content_uploads/'.$data->filename);
            Storage::delete('public/content_uploads/thumbnails/'.$data->filename);
            }
            if($data->iconfile != ''){
            Storage::delete('public/content_uploads/icons/'.$data->iconfile);
            //Storage::delete('public/content_uploads/icons/thumbnails/'.$data->iconfile);
            }
             if($data->featured_video != ''){
            Storage::delete('public/content_uploads/videos/'.$data->featured_video);
           // Storage::delete('public/content_uploads/videos/thumbnails/'.$data->featured_video);
            }
       $deleted = $data->delete();


       if($deleted){

$info = content_details::where('related_id', $id)->get();
if(count($info) >0){
  foreach($info as $Info){

    if($Info->filenamelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->filenamelist);
    Storage::delete('public/content_uploads/details/thumbnails/'.$Info->filenamelist);
    }
    if($Info->iconfilelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->iconfilelist);
    //Storage::delete('public/content_uploads/details/thumbnails/'.$Info->iconfilelist);
    }
     if($Info->video_filelist != ''){
    Storage::delete('public/content_uploads/details/'.$Info->video_filelist);
    // Storage::delete('public/content_uploads/details/thumbnails/'.$Info->video_filelist);
    }

}
}

$sqlQuery =DB::delete('delete from content_details where related_id = ?',[$id]);
       }


return $deleted;

    }
}
