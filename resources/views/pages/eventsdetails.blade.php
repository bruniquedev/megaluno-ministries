
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Events" && $option=="All"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->descriptiontext)
@section('keywords',$SEODataInfo->keywordstext)
<?php }else if($option=="details"){ ?>

@section('title',$Details[0]['headingtext'])
@section('description',$Details[0]['descriptiontext'])
@section('keywords',$Details[0]['headingtext'].' , '.$Details[0]['descriptiontext'])

<?php } ?>
@endforeach
@endif
<!--/seo-->

@section('content') 


 <section class="main-content-section w-full m-t-100 m-b-50">
    <div class="main-content-container">

<!--about section-->
    <div class="section_area">

   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex flex-column justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo"All EVENTS: ";}else{?> {{$title}} : Event <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->


<?php if($option=="details"){ ?>
    <!--about section-->
    <div class="section_area">
<div class="aboutarea sneekpeek-details-area background-img bg-img-attachment" style="background-image: url('{{asset("storage/events_images/thumbnails/".$Details[0]["filename"]) }}');"><!---->
 <div class="about-container package-tour-container flex justify-center flex-wrap flex-grow animate-element delay6 fadeInLeft-anime "> 

<!--with an image-->
  <div class="content-container-img w-45">
  <img src='{{asset("storage/events_images/thumbnails/".$Details[0]["filename"]) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
<!--with content-->
<div class="about-content sneekpeek-detail-content w-45">
  <h1 class="f-s-20 f-w-500 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$Details[0]['headingtext']}}</a></span></h1>
    <div class="border-separator w-full"></div>
 @if(count($detailItems) > 0) 
@foreach ($detailItems as $info)
<p>@if($info->heading!="") <span class="f-w-600 color-black-dark m-r-3">{{$info->heading}} :</span> @endif
   {{$info->description}}</p> 
@endforeach
@endif 
</div>
<!--/with content-->

  </div> 
</div>
</div>
<!--/about section-->
<?php } ?>


<!--about section-->
 <?php if($option=="details"){ ?>
 @if(count($DataDonationsInfo) > 0)
    <div class="section_area m-t-30">
<div class="aboutarea background-img sneekpeekarea bg-img-attachment" style="background-image: url('{{asset("storage/donations_images/thumbnails/".$DataDonationsInfo[0]->filename) }}');">
 <div class="about-container sneekpeek-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content sneekpeek-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-white"><span class="font-century-light">Donate and Give</span> :</a></span></h1>

    <div class="border-separator w-full"></div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/donate" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui donate-btn">Donate <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endif
<?php } ?>
<!--/about section-->


<section class="section_area m-t-20">
 
 <?php if($option=="details"){ ?>
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light">OTHER EVENTS</span> :</a></span></h1><?php } ?>

<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini ">
 
 @if(count($DataInfo) > 0) 
@foreach ($DataInfo as $info)
    <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/event/{{$info->id}}/{{$info->headingtext}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/events_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/event/{{$info->id}}/{{$info->headingtext}}">{{$info->headingtext}}</a> 
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

