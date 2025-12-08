<?php
namespace App\Services;
use Illuminate\Support\Facades\Schema;
use DB;//import if you want to use sql commands directly
use Hash;
use Response;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
use App\Models\content_info;
use App\Models\content_details;
use App\AppHelper;
class ContentService
{



public function saveContentInfo(array $data, array $files = [], $id = null)
    {
        return DB::transaction(function () use ($data, $files, $id) {

            $info = content_info::find($id); 

            // Handle main file upload
            if (isset($files['input_file']) && !empty($files['input_file'])) {
			//handling the file upload
			$upload_dir="content_uploads";
			$thumbnail_dir="thumbnails";
			$isToresize=$data['isToresize'];
			$max_width=$data['max_width'];
			$fileNameToStore="";
			if(!empty($files['input_file'])){
			$fileinput = $files['input_file'];
			$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

			//delete previous file here
			if($id!=null && $id > 0){
			if($info->filename != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->filename);
			}
		      }
               //set new file
                $data['filename'] = $fileNameToStore;
            }

              // Handle icon file upload
            if (isset($files['input_icon']) && !empty($files['input_icon'])) {
			//handling the file upload
			$upload_dir="content_uploads/icons";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=0;
			$fileNameToStore="";
			if(!empty($files['input_icon'])){
			$fileinput = $files['input_icon'];
			$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

			//delete previous file here
			if($id!=null && $id > 0){
			if($info->iconfile != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->iconfile);
			}
		      }
               //set new file
                $data['iconfile'] = $fileNameToStore;
            }



            // Handle video file upload
            if (isset($files['input_video']) && !empty($files['input_video'])) {
			//handling the file upload
			$upload_dir="content_uploads/videos";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=0;
			$fileNameToStore="";
			if(!empty($files['input_video'])){
			$fileinput = $files['input_video'];
			$fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

				//delete previous file here
			if($id!=null && $id > 0){
			if($info->featured_video != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->featured_video);
			}
		      }
               //set new file
                $data['featured_video'] = $fileNameToStore;
            }


            // Create or update the content info row
            $content = content_info::updateOrCreate(
                ['id' => $id],
                $data
            );

            return $content;
        });
    }

    public function saveContentDetails($contentId, array $details)
    {



//create and Initialize an empty array of selected ids
//let's first delete ids of items which are not in this array
  if($contentId!=null && $contentId > 0){
        
$selected_ids = array();
  foreach ($details as $selected){
    if($selected['id']!=0){
  $selected_ids[] = $selected['id']; //add id's of submitted form fields
      }
      }
      if(count($selected_ids) > 0){//check if there are any id's in an array
          // Get the ids separated by comma
  $in_clause_ids = implode(", ", $selected_ids);

//delete related images of content_details which are about to be deleted
$sqldetails =DB::select('select * from content_details where related_id=:id AND id NOT IN ('.$in_clause_ids.')',['id'=>$contentId]);

foreach ($sqldetails as $Info){
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
$sqlQuery =DB::delete('Delete from content_details where related_id=:id AND id NOT IN ('.$in_clause_ids.')',['id'=>$contentId]);
}
}


        foreach ($details as $detail) {

        	$info = content_details::find($detail['id']);

            // File uploads
            if (isset($detail['input_filelist']) && !empty($detail['input_filelist'])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=$detail['isToresize'];
			$max_width=$detail['max_width'];
			$fileNameToStore="";
			if(!empty($detail['input_filelist'])){
			$fileinput = $detail['input_filelist'];
            $fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

               //delete previous file here
			if($detail['id']!=null && $detail['id'] > 0){
			if($info->filenamelist != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->filenamelist);
			}
		      }
               //set new file

              $detail['filenamelist'] = $fileNameToStore;
            }


             // icon File uploads
            if (isset($detail['input_iconlist']) && !empty($detail['input_iconlist'])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=0;
			$fileNameToStore="";
			if(!empty($detail['input_iconlist'])){
			$fileinput = $detail['input_iconlist'];
            $fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

			          //delete previous file here
			if($detail['id']!=null && $detail['id'] > 0){
			if($info->iconfilelist != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->iconfilelist);
			}
		      }
               //set new file
              $detail['iconfilelist'] = $fileNameToStore;
            }


            // icon File uploads
            if (isset($detail['input_videolist']) && !empty($detail['input_videolist'])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=0;
			$fileNameToStore="";
			if(!empty($detail['input_videolist'])){
			$fileinput = $detail['input_videolist'];
            $fileNameToStore = (new AppHelper())->StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput);
			}

			        //delete previous file here
			if($detail['id']!=null && $detail['id'] > 0){
			if($info->video_filelist != ''){
			(new AppHelper())->DeleteFileHelper($upload_dir,$thumbnail_dir,$info->video_filelist);
			}
		      }
               //set new file
              $detail['video_filelist'] = $fileNameToStore;
            }
                 
               $detail['related_id'] = $contentId;
            // Update/create each detail row
            content_details::updateOrCreate(
                ['id' => $detail['id'] ?? null],
                $detail
            );
        }
    }





	}
?>