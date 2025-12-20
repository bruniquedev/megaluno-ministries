
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->detail_type=="About"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->description)
@section('keywords',$SEODataInfo->heading)
<?php } ?>
@endforeach
@endif
<!--/seo-->

@section('content') 


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container">


 @if(count($AboutinfoData) > 0) 
@foreach ($AboutinfoData as $info)

 @if($info->filename!="")
<!--about section-->
    <div class="section_area m-b-10">

<div class="abt-container flex flex-wrap flex-grow align-items-center w-100">
<div class="aboutarea abt-1 w-50">
  <!--with an image-->
  <div class="m-t-10 m-b-30 content-container-img w-100">
  <img src='{{asset("storage/content_uploads/thumbnails/".$info->filename) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
</div>

<div class="aboutarea abt-1 w-50">
 <div class="about-container animate-element delay6 fadeInLeft-anime w-85"> 
<div class="about-content p-0p">

@if($info->iconfile)
<div class="w-100 flex justify-center">
 <div class="summary_img_wrapper">
  <img src='{{asset("storage/content_uploads/icons/".$info->iconfile) }}' alt="img" class="summary_img" />
</div>
</div>
@endif

@if($info->title)
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$info->title}}</a></span></h1>
    <div class="border-separator w-full"></div>
    @endif

@if($info->description)
<p>{{$info->description}}</p>
@endif

@if(count($About_detailsData) > 0)
@foreach($About_detailsData as $About_detail)
@if($About_detail->related_id==$info->id)
<div class="about-detailed">
<div class="flex  flex-grow align-items-center">

@if($About_detail->iconfilelist)
  <div class="summary_img_wrapper w-30">
  <img src='{{asset("storage/content_uploads/details/".$About_detail->iconfilelist) }}' alt="img" class="summary_img" /></div>
  @endif

<div>
  @if($About_detail->headinglist)
  <h1 class=" f-s-20 animate-element">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$About_detail->headinglist}}</a></span></h1>
 @endif
  @if($About_detail->descriptionlist)
<p>{{$About_detail->descriptionlist}}</p> 
 @endif
</div>

</div>

@if($About_detail->filenamelist)
<!--with an image-->
  <div class="m-t-10 m-b-20 content-container-img w-100 flex flex-column justify-center">
  <img src='{{asset("storage/content_uploads/details/thumbnails/".$About_detail->filenamelist) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
 @endif
</div>
@endif
@endforeach
@endif

</div>
  </div> 
</div>
</div>
</div>
<!--/about section-->
@endif


@if($info->filename=="")
<!--about section-->
    <div class="section_area m-b-10">

<div class="abt-container">
<div class="aboutarea abt-1">
 <div class="about-container animate-element delay6 fadeInLeft-anime w-100"> 
<div class="about-content p-0p">

@if($info->iconfile)
<div class="w-100 flex justify-center">
 <div class="summary_img_wrapper">
  <img src='{{asset("storage/content_uploads/icons/".$info->iconfile) }}' alt="img" class="summary_img" />
</div>
</div>
@endif

@if($info->title)
  <h1 class="center f-s-25 m-b-10">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$info->title}}</a></span></h1>
    <div class="border-separator w-full"></div>
@endif

@if($info->description)
<p>{{$info->description}}</p>
@endif


@if(count($About_detailsData) > 0)
@foreach($About_detailsData as $About_detail)
@if($About_detail->related_id==$info->id)
<div class="about-detailed">
<div class="flex  flex-grow align-items-center">

@if($About_detail->iconfilelist)
  <div class="summary_img_wrapper w-20 m-r-1">
  <img src='{{asset("storage/content_uploads/details/".$About_detail->iconfilelist) }}' alt="img" class="summary_img" /></div>
  @endif

<div>
  @if($About_detail->headinglist)
  <h1 class=" f-s-20 animate-element">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$About_detail->headinglist}}</a></span></h1>
 @endif
  @if($About_detail->descriptionlist)
<p>{{$About_detail->descriptionlist}}</p> 
 @endif
</div>

</div>

@if($About_detail->filenamelist)
<!--with an image-->
  <div class="m-t-10 m-b-20 content-container-img flex flex-column justify-center">
  <img src='{{asset("storage/content_uploads/details/thumbnails/".$About_detail->filenamelist) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
 @endif
</div> 
@endif
@endforeach
@endif

</div>
  </div> 
</div>
</div>
</div>
<!--/about section-->
@endif



@endforeach
@endif


    </div>
</section>



@endsection
<!--code above is for templating-->

