
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Donation"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->descriptiontext)
@section('keywords',$SEODataInfo->keywordstext)
<?php } ?>
@endforeach
@endif
<!--/seo-->


@section('content') 

<section class="main-content-section w-full m-t-100 m-b-50">
    <div class="main-content-container">


 @if(count($DataDonationsInfo) > 0) 
<!--about section-->
    <div class="section_area m-t-30">
<div class="aboutarea background-img pagecontainerarea bg-img-attachment" style="background-image: url('{{asset("storage/donations_images/thumbnails/".$DataDonationsInfo[0]->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content pagearea-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-white"><span class="font-century-light">Donate and Give</span> :</a></span></h1>

    <div class="border-separator w-full"></div>


<div class="flex justify-center align-items-center m-t-10">

  <div class="item-col">
    <div class="item-separator item-separator-grey h-200p"></div>
  </div>
  <div class="item-col">
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-white">{{$DataDonationsInfo[0]->headingtext}}</a></span></h3>

@foreach ($Donation_detailsData as $info) 
<p>{{$info->description}}</p>
@endforeach 
</div>

</div>


<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="javascript:void(0);" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui donate-btn">Donate with :<i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endif
<!--/about section-->





    </div>
</section>







@endsection
<!--code above is for templating-->

