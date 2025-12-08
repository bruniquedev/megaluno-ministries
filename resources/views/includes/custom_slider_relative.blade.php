  <section id="slider-feature" class="mobile-relative-slider-feature">
   <div class="card-wrappable">

<div class="slider-content slider-section mobile-relative-slider-content" id="slider-content" onmouseover="showControls();"  onmouseout="hideControls()">

       @if(count($SliderData) > 0)

<?php //var_dump($SliderData);
$animate_position="";
 ?>
<!--iterate through an array-->
@foreach($SliderData as $SliderInfo)

<?php

 if($animate_position=="slide-animate-left"){ 
$animate_position="slide-animate-right";
}else{
  $animate_position="slide-animate-left";
} ?>
 
  <div class="mySlides {{$animate_position}}" style="background-image: url('{{"storage/content_uploads/thumbnails/".$SliderInfo->filename }}');">
<div class="slider-caption mobile-relative-slider-caption animate-element delay4 fadeInDown-animation fadeInDown">
<h3 class="animate-element delay9 fadeInDown-animation fadeInDown mobile-relative-slider-caption-heading f-w-500 f-s-90 font-century-bold">{{$SliderInfo->heading}}</h3> 
 <?php if($SliderInfo->description!=""){ ?>
<p class="text-para animate-element delay9 fadeInUp-animation fadeInUp mobile-relative-slider-caption-desc f-w-500">{{$SliderInfo->description}}</p><?php } ?>
 <?php
   $buttontext="More details...";
   $buttonlink="javascript:void(0);";
  if($SliderInfo->link_redirect!=""){ 
   $buttonlink=$SliderInfo->link_redirect;
   }
    if($SliderInfo->title!=""){ 
   $buttontext=$SliderInfo->title;
  ?>
<div class="btn-slider animate-element delay9 fadeInDown-animation fadeInDown m-t-20"><a class="get-touch-btn mobile-relative-slider-get-touch-btn" href="{{$buttonlink}}">{{$buttontext}}</a></div>
<?php } ?>
</div>
  </div>

  @endforeach
@endif


  <a href="javascript:void(0);" class="slider_left_button" id="left_control">
    <div>
        <span class="ic"><i  id="slider-nav-icon" class="ion-android-arrow-dropleft-circle slider-nav-icon"></i></span>
    </div>
</a>

  <a href="javascript:void(0);" class="slider_right_button" id="right_control">
    <div>
        <span class="ic"><i  id="slider-nav-icon" class="ion-android-arrow-dropright-circle  slider-nav-icon"></i></span>
    </div>
</a>
</div>

<div class="slider-indicators-container ">
  <div class="slider-indicators">
  @if(count($SliderData) > 0)
<?php $counter=0; ?>
<!--iterate through an array-->
@foreach($SliderData as $Info)

  <span class="slider-indicator-dot" data-index="<?php echo$counter; ?>"></span>
  <?php $counter++; ?>
  @endforeach
@endif
</div>
</div>

 </div>
     </section>