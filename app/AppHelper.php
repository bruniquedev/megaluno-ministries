<?php
//namespace App\Helpers;
namespace App;
use Illuminate\Support\Facades\Schema;
use DB;//import if you want to use sql commands directly
use Hash;
use Response;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;// will enable us access storage 
class AppHelper
{


//https://stackoverflow.com/questions/44021662/how-to-create-global-function-that-can-be-accessed-from-any-controller-and-blade
    //after clear= php artisan config:clear
//https://stackoverflow.com/questions/56920497/laravel-helper-class-are-not-being-called
    //composer dump-autoload in terminal

  public function StoreFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$fileinput)
      {

    //handling the file upload
//check if user has opted to upload the file
if(!empty($fileinput)){
//get file name with extension
$fileNameWithExt = strtolower($fileinput->getClientOriginalName());

//get just file name
$fileName = pathinfo($fileNameWithExt,PATHINFO_FILENAME);
//get the extension
$extension = $fileinput->getClientOriginalExtension();
    //file name to store  we concatinate time to differentiate a file from other files
    $fileNameToStore  = $fileName.'_'.time().'.'.strtolower($extension); 
    //upload the file 
    
    $path=$fileinput->storeAs('public/'.$upload_dir,$fileNameToStore);

    //check if file to upload is an image
if(isImage($fileNameWithExt)){

      if($isToresize==1){
    $paththumnail=$fileinput->storeAs('public/'.$upload_dir.'/'.$thumbnail_dir.'/',$fileNameToStore); 
       /////////////resize the image /////////////////////
$pathToThumbnail ="storage/".$upload_dir."/".$thumbnail_dir."/".$fileNameToStore; 

      $width = getWidth($pathToThumbnail);
      $height = getHeight($pathToThumbnail);
       //Scale the image if it is greater than the max_width set above
       if ($width > $max_width){

        $scale = $max_width/$width;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }else{
        $scale = 1;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }
      }

     }//end checking if it's an image


     }else{
        $fileNameToStore ='nofile.png';
        }


             return $fileNameToStore;
      }




public function StoreBase64ImageFileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$requestinputvalue){

//https://www.nicesnippets.com/blog/how-to-upload-base64-encoded-images-with-laravel
//https://laracasts.com/discuss/channels/laravel/create-image-from-base64-string-laravel

 if ($requestinputvalue) {
        $base64Image = explode(";base64,", $requestinputvalue);
        $explodeImage = explode("image/", $base64Image[0]);
        $imageType = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
 $fileNameToStore  = substr(uniqid(rand(), true), 6, 6).'_'.time().'.'.$imageType; 
  //upload the file 
   // $path =Storage::disk('public/'.$upload_dir)->put($fileNameToStore, $image_base64);
 $folderPath = public_path().'/storage'. '/'.$upload_dir.'/';
 $file = $folderPath.$fileNameToStore;
 file_put_contents($file, $image_base64);//upload finally

      if($isToresize==1){
        //upload image to thumnail folder
//$paththumnail =Storage::disk('public/'.$upload_dir.'/'.$thumbnail_dir)->put($fileNameToStore, $image_base64);
$folderPath = public_path().'/storage' . '/'.$upload_dir.'/'.$thumbnail_dir.'/';
 $file = $folderPath.$fileNameToStore;
 file_put_contents($file, $image_base64);//upload finally

       /////////////resize the image /////////////////////
$pathToThumbnail ="storage/".$upload_dir."/".$thumbnail_dir."/".$fileNameToStore; 

      $width = getWidth($pathToThumbnail);
      $height = getHeight($pathToThumbnail);
       //Scale the image if it is greater than the max_width set above
       if ($width > $max_width){
        $scale = $max_width/$width;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }else{
        $scale = 1;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }
      }


    }else{
        $fileNameToStore ='nofile.png';
        }


             return $fileNameToStore;
      }

//upload to amazon web service
public function StoreBase64ImageTo_AWS_FileHelper($upload_dir,$thumbnail_dir,$isToresize,$max_width,$requestinputvalue){

//https://www.nicesnippets.com/blog/how-to-upload-base64-encoded-images-with-laravel
//https://laracasts.com/discuss/channels/laravel/create-image-from-base64-string-laravel

 if ($requestinputvalue) {
        $base64Image = explode(";base64,", $requestinputvalue);
        $explodeImage = explode("image/", $base64Image[0]);
        $imageType = $explodeImage[1];
        $image_base64 = base64_decode($base64Image[1]);
 $fileNameToStore  = substr(uniqid(rand(), true), 6, 6).'_'.time().'.'.$imageType; 
  //upload the file 
    $path = Storage::disk('s3.bucket')->put($fileNameToStore, $image_base64, 'public/'.$upload_dir);

      if($isToresize==1){
        //upload image to thumnail folder
    $paththumnail = Storage::disk('s3.bucket')->put($fileNameToStore, $image_base64, 'public/'.$upload_dir.'/'.$thumbnail_dir);
       /////////////resize the image /////////////////////
$pathToThumbnail ="storage/".$upload_dir."/".$thumbnail_dir."/".$fileNameToStore; 

      $width = getWidth($pathToThumbnail);
      $height = getHeight($pathToThumbnail);
       //Scale the image if it is greater than the max_width set above
       if ($width > $max_width){
        $scale = $max_width/$width;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }else{
        $scale = 1;
        $uploaded = resizeImage($pathToThumbnail,$width,$height,$scale);
      }
      }


    }else{
        $fileNameToStore ='nofile.png';
        }


             return $fileNameToStore;
      }







 public function DeleteFileHelper($upload_dir,$thumbnail_dir,$filename)
      {
             $status = 0;
           if($filename != 'user.png' || $filename != 'nofile.png' ){
            
            Storage::delete('public/'.$upload_dir.'/'.$thumbnail_dir.'/'.$filename);
            Storage::delete('public/'.$upload_dir.'/'.$filename);
             $status = 1;
            }

             return $status;
      }


 public function UpdateFileHelper($someValue)
      {
             return "increment $someValue";
      }

    /*
      public function bladeHelper($someValue)
      {
             return "increment $someValue";
      }

     public function startQueryLog()
     {
           \DB::enableQueryLog();
     }

     public function showQueries()
     {
          dd(\DB::getQueryLog());
     }

     public static function instance()
     {
         return new AppHelper();
     }
     */








}
?>