<?php

 function Title_and_description($page){
  $results = DB::table('content_info')->where('title',$page)->where('page_area_type','pagetitle')->orderBy('sorted_order', 'asc')->first();
if($results!=null){
    $heading = $results->heading;
    $description = $results->description;
    return ['heading' => $heading, 'description' => $description];
    // Usage in blade
/*$values = Title_and_description($page,$feature,$accid);
$result1 = $values['value1'];
$result2 = $values['value2'];*/

}
   return ['heading' => '', 'description' => ''];//may be zero
    } 



function Is_internet_connected(){
      $host = 'www.google.com';
    $port = 80;
    $timeout = 5;
 $connected = @fsockopen($host, $port, $errno, $errstr, $timeout);
    if ($connected) {
        fclose($connected);

        return true;
      }
      return false;
}

/////////////////////////////////////////////////////////////////////
function isImage($image){
    $extension = pathinfo($image, PATHINFO_EXTENSION);
    $imgExtArr = ['jpg', 'jpeg', 'png', 'gif'];
    if(in_array($extension, $imgExtArr)){
        return true;
    }
    return false;
}

function is_image($path)
{
  $a = getimagesize($path);
  $image_type = $a[2];
  
  if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
  {
    return true;
  }
  return false;
}

/////////////////////////////////////////////////////////////////

function stringInsert($str,$insertstr,$pos){
  $count_str=strlen($str);
  $new_str="";
  for($i=0;$i<$pos;$i++)
    {
      if (isset($str[$i])) {
    $new_str .= $str[$i];
  }
    }

    $new_str .=$insertstr;

   for($i=$pos;$i<$count_str;$i++)
    {
      if (isset($str[$i])) {
    $new_str .= $str[$i];
  }
    }

  return $new_str;

} 


//helper php file  where we place our helper functions
##########################################################################################################
//escapes a string

    function mysql_escape($inp)
    { 
        if(is_array($inp)) return array_map(__METHOD__, $inp);

        if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
        } 

        return $inp; 
    }

##########################################################################################################

function str_limit($text, $limit) {
  if (str_word_count($text, 0) > $limit) {
      $words = str_word_count($text, 2);
      $pos   = array_keys($words);
      $text  = substr($text, 0, $pos[$limit]) . '...';
  }
  return $text;
}

function Str_text_limit($originalString, $maxCharacters) {
  $shortenedString="";
  if (strlen($originalString) > $maxCharacters) {
    $shortenedString = substr($originalString, 0, $maxCharacters) . "...";
} else {
    $shortenedString = $originalString;
}
return $shortenedString;
}


##########################################################################################################
//time ago function
 function time_ago_in_php($timestamp){
  
        date_default_timezone_set('Africa/Kampala');         
        $time_ago        = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;
        
        $minutes = round($seconds / 60); // value 60 is seconds  
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
        $weeks   = round($seconds / 604800); // 7*24*60*60;  
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60
                      
        if ($seconds <= 60){
      
          return "Just Now";
      
        } else if ($minutes <= 60){
      
          if ($minutes == 1){
      
            return "1 minute ago";
      
          } else {
      
            return "$minutes minutes ago";
      
          }
      
        } else if ($hours <= 24){
      
          if ($hours == 1){
      
            return "an hour ago";
      
          } else {
      
            return "$hours hrs ago";
      
          }
      
        } else if ($days <= 7){
      
          if ($days == 1){
      
            return "yesterday";
      
          } else {
      
            return "$days days ago";
      
          }
      
        } else if ($weeks <= 4.3){
      
          if ($weeks == 1){
      
            return "a week ago";
      
          } else {
      
            return "$weeks weeks ago";
      
          }
      
        } else if ($months <= 12){
      
          if ($months == 1){
      
            return "a month ago";
      
          } else {
      
            return "$months months ago";
      
          }
      
        } else {
          
          if ($years == 1){
      
            return "one year ago";
      
          } else {
      
            return "$years years ago";
      
          }
        }
      }


##########################################################################################################



##########################################################################################################
//for getting base urls



    function getBaseUrl() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
    
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
    
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
    
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
    
        // return: http://localhost/myproject/
        return $protocol.'://'.$hostName.$pathInfo['dirname']."/";
    }
    
    
    function getBaseUrlTwo() 
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF']; 
    
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
        $pathInfo = pathinfo($currentPath); 
    
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST']; 
    
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';
    
        // return: http://localhost/myproject/
        return $protocol.'://'.$hostName;
    }
    
    
    
    function getBaseUrlThree() 
    {
        // first get http protocol if http or https
    
    $base_url = (isset($_SERVER['HTTPS']) &&
    
    $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
    
    // get default website root directory
    
    $tmpURL = dirname(__FILE__);
    
    // when use dirname(__FILE__) will return value like this "C:\xampp\htdocs\my_website",
    
    //convert value to http url use string replace, 
    
    // replace any backslashes to slash in this case use chr value "92"
    
    $tmpURL = str_replace(chr(92),'/',$tmpURL);
    
    // now replace any same string in $tmpURL value to null or ''
    
    // and will return value like /localhost/my_website/ or just /my_website/
    
    $tmpURL = str_replace($_SERVER['DOCUMENT_ROOT'],'',$tmpURL);
    
    // delete any slash character in first and last of value
    
    $tmpURL = ltrim($tmpURL,'/');
    
    $tmpURL = rtrim($tmpURL, '/');
    
    
    // check again if we find any slash string in value then we can assume its local machine
    
        if (strpos($tmpURL,'/')){
    
    // explode that value and take only first value
    
           $tmpURL = explode('/',$tmpURL);
    
           $tmpURL = $tmpURL[0];
    
          }
    
    // now last steps
    
    // assign protocol in first value
    
       if ($tmpURL !== $_SERVER['HTTP_HOST'])
    
    // if protocol its http then like this
    
          $base_url .= $_SERVER['HTTP_HOST'].'/'.$tmpURL.'/';
    
        else
    
    // else if protocol is https
    
          $base_url .= $tmpURL.'/';
    
    // give return value
    
    return $base_url; 
    
    }   


##########################################################################################################



##########################################################################################################
# IMAGE FUNCTIONS                                            #
# You do not need to alter these functions                                 #
##########################################################################################################

    function resizeImage($image,$width,$height,$scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
          case "image/gif":
            $source=imagecreatefromgif($image); 
            break;
            case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
            $source=imagecreatefromjpeg($image); 
            break;
            case "image/png":
          case "image/x-png":
            $source=imagecreatefrompng($image); 
            break;
          }
      
      
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        
        switch($imageType) {
          case "image/gif":
              imagegif($newImage,$image); 
            break;
              case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
              imagejpeg($newImage,$image,90); 
            break;
          case "image/png":
          case "image/x-png":
            imagepng($newImage,$image);  
            break;
          }
        
        chmod($image, 0777);
        return $image;
      }
      
      function resizeImageBothScaling($image,$width,$height,$scale_width,$scale_height) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale_width);
        $newImageHeight = ceil($height * $scale_height);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
          case "image/gif":
            $source=imagecreatefromgif($image); 
            break;
            case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
            $source=imagecreatefromjpeg($image); 
            break;
            case "image/png":
          case "image/x-png":
            $source=imagecreatefrompng($image); 
            break;
          }
      
      
        imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
        
        switch($imageType) {
          case "image/gif":
              imagegif($newImage,$image); 
            break;
              case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
              imagejpeg($newImage,$image,90); 
            break;
          case "image/png":
          case "image/x-png":
            imagepng($newImage,$image);  
            break;
          }
        
        chmod($image, 0777);
        return $image;
      }
    
      //You do not need to alter these functions
      function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
        switch($imageType) {
          case "image/gif":
            $source=imagecreatefromgif($image); 
            break;
            case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
            $source=imagecreatefromjpeg($image); 
            break;
            case "image/png":
          case "image/x-png":
            $source=imagecreatefrompng($image); 
            break;
          }
        imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
        switch($imageType) {
          case "image/gif":
              imagegif($newImage,$thumb_image_name); 
            break;
              case "image/pjpeg":
          case "image/jpeg":
          case "image/jpg":
              imagejpeg($newImage,$thumb_image_name,90); 
            break;
          case "image/png":
          case "image/x-png":
            imagepng($newImage,$thumb_image_name);  
            break;
          }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
      }
      //You do not need to alter these functions
      function getHeight($image) {
        $size = getimagesize($image);
        $height = $size[1];
        return $height;
      }
      //You do not need to alter these functions
      function getWidth($image) {
        $size = getimagesize($image);
        $width = $size[0];
        return $width;
      }   

##########################################################################################################
?>