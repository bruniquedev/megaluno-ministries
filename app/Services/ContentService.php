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
            if (isset($files['input_file'])) {
			//handling the file upload
			$upload_dir="content_uploads";
			$thumbnail_dir="thumbnails";
			$isToresize=1;
			$max_width=$data['file_width'];
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
            if (isset($files['input_icon'])) {
			//handling the file upload
			$upload_dir="content_uploads/icons";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=$data['icon_width'];
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
            if (isset($files['input_video'])) {
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

    public function saveContentDetails($contentId, array $details, array $files = [])
    {
        foreach ($details as $detail) {

        	$info = content_details::find($detail['id']);

            // File uploads
            if (isset($files[$detail['input_filelist']])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=1;
			$max_width=$detail['file_widthlist'];
			$fileNameToStore="";
			if(!empty($files[$detail['input_filelist']])){
			$fileinput = $files[$detail['input_filelist']];
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
            if (isset($files[$detail['input_iconlist']])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=$detail['icon_widthlist'];
			$fileNameToStore="";
			if(!empty($files[$detail['input_iconlist']])){
			$fileinput = $files[$detail['input_iconlist']];
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
            if (isset($files[$detail['input_videolist']])) {

                $upload_dir="content_uploads/details";
			$thumbnail_dir="thumbnails";
			$isToresize=0;
			$max_width=0;
			$fileNameToStore="";
			if(!empty($files[$detail['input_videolist']])){
			$fileinput = $files[$detail['input_videolist']];
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


            // Update/create each detail row
            content_details::updateOrCreate(
                [
                    'related_id' => $contentId,
                    'id' => $detail['id'] ?? null
                ],
                $detail
            );
        }
    }





	}
?>