
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->detail_type=="Events" && $option=="All"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->description)
@section('keywords',$SEODataInfo->heading)
<?php }else if($option=="details"){ ?>

@section('title',$Details->title)
@section('description',$Details->description)
@section('keywords',$Details->title)

<?php } ?>
@endforeach
@endif
<!--/seo-->

@section('content') 


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container">

<!--about section-->
    <div class="section_area">

   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex flex-column justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo$title;}else{?> {{$title}} : Upcoming Event <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->


<?php if($option=="details"){ ?>
    <!--about section-->
    <div class="section_area">
<div class="aboutarea pagecontainer-details-area background-img bg-img-attachment" style="background-image: url('{{asset("storage/content_uploads/thumbnails/".$Details->filename) }}');"><!---->
 <div class="about-container more-details-container flex justify-center flex-wrap flex-grow animate-element delay6 fadeInLeft-anime "> 

<!--with an image-->
  <div class="content-container-img w-45">

  </div>
<!--/with an image-->
<!--with content-->
<div class="about-content pagearea-detail-content w-45">

   @if($Details->title)
  <h1 class="f-s-20 f-w-500 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$Details->title}}</a></span></h1>
    <div class="border-separator w-full"></div>
     @endif

  @if($Details->description)
  <p>{{$Details->description}}</p>
  @endif

@if($Details->filename)
<!--with an image-->
  <div class="m-t-10 m-b-30 content-container-img w-100">
  <img src='{{asset("storage/content_uploads/thumbnails/".$Details->filename) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
@endif


@if(count($detailItems) > 0)
@foreach($detailItems as $info_detail)
@if($info_detail->related_id==$Details->id)

@if($info_detail->headinglist || $info_detail->descriptionlist)
<div class="head-description m-t-20">
@if($info_detail->headinglist)
<h5 class="m-t-10 m-b-10 f-w-500 f-s-18">{{$info_detail->headinglist}}</h5>
<div class="border-separator w-full"></div>
@endif
@if($info_detail->descriptionlist)
<p>{{$info_detail->descriptionlist}}</p>
@endif
</div>
@endif

@if($info_detail->filenamelist)
<!--with an image-->
  <div class="content-container-img w-100">
  <img src='{{asset("storage/content_uploads/details/thumbnails/".$info_detail->filenamelist) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
@endif

@endif
@endforeach
@endif






</div>
<!--/with content-->

  </div> 
</div>
</div>
<!--/about section-->
<?php } ?>




<section class="section_area m-t-20">
 
 <?php if($option=="details"){ ?>
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="">OTHER EVENTS</span> :</a></span></h1><?php } ?>

<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini ">
 
 @if(count($DataInfo) > 0) 
@foreach ($DataInfo as $info)
    <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/event/{{$info->id}}/{{$info->slug}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/content_uploads/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/event/{{$info->id}}/{{$info->slug}}">{{$info->title}}</a> 
    </div>
</div>
</div>
  </div>
<!--item-->
@endforeach
@endif 
</div>

 <?php if($option=="details"){ ?>
<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/events" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More events <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
<?php } ?>
</section>



    </div>
</section>



@endsection
<!--code above is for templating-->

