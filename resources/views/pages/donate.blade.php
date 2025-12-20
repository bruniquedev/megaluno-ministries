
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->detail_type=="Donation"){ 
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


 @if(count($DataDonationsInfo) > 0) 
 @foreach ($DataDonationsInfo as $info) 
<!--about section-->
    <div class="section_area m-t-30">
<div class="aboutarea background-img pagecontainerarea bg-img-attachment" style="background-image: url('{{asset("storage/content_uploads/thumbnails/".$info->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content pagearea-content">

@if($info->title)
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black"><span class="">{{$info->title}}</span></a></span></h1>
    <div class="border-separator w-full"></div>
  @endif

    @if($info->description)
<p>{{$info->description}}</p>
  @endif


<div class="flex justify-center align-items-center m-t-10">
  <div class="item-col">
    <div class="item-separator item-separator-grey h-200p"></div>
  </div>
  <div class="item-col">

@if(count($Donation_detailsData) > 0)
@foreach ($Donation_detailsData as $donation_detail)
@if($donation_detail->related_id==$info->id) 

<div class="about-detailed">

    @if($donation_detail->headinglist)
  <h1 class=" f-s-20 animate-element m-t-20">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$donation_detail->headinglist}}</a></span></h1>
 @endif
<div class="flex flex-wrap  flex-grow align-items-center">

@if($donation_detail->filenamelist)
<!--with an image-->
  <div class="m-t-10 m-b-20 content-container-img m-r-20 w-100 flex flex-column justify-center">
  <img src='{{asset("storage/content_uploads/details/thumbnails/".$donation_detail->filenamelist) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
  @endif

<div>

  @if($donation_detail->descriptionlist)
<p>{{$donation_detail->descriptionlist}}</p> 
 @endif
</div>

</div>

</div>

 
@endif
@endforeach
@endif
</div>
</div>


<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="javascript:void(0);" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui donate-btn">Donate with :<i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endforeach 
@endif
<!--/about section-->





    </div>
</section>







@endsection
<!--code above is for templating-->

