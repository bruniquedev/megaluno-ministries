
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Programmes" && $option=="All"){ 
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


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container full-detail">

<!--about section-->
    <div class="section_area">

   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex flex-column justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo"All MINISTRIES ";}else{?> {{$title}}  <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->


<?php if($option=="details"){ ?>
    <!--about section-->
    <div class="section_area">
<div class="aboutarea pagecontainer-details-area"><!---->
 <div class="about-container more-details-container w-80 flex flex-column  flex-wrap flex-grow animate-element delay6 fadeInLeft-anime "> 


<!--with content-->
<div class="about-content pagearea-detail-content">
 

<div class="head-description m-b-20">
<h5 class="m-t-10 m-b-10 f-w-500 f-s-18">Mission or purpose.</h5>
<div class="border-separator w-full"></div>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.</p>
</div>

<div class="head-description m-b-20">
<h5 class="m-t-10 m-b-10 f-w-500 f-s-18">Meeting times or schedules.</h5>
<div class="border-separator w-full"></div>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.</p>
</div>



<div class="head-description m-b-20">
<h5 class="m-t-10 m-b-10 f-w-500 f-s-18">Contact or registration info.</h5>
<div class="border-separator w-full"></div>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.</p>
</div>


<div class="head-description m-b-20">
<h5 class="m-t-10 m-b-10 f-w-500 f-s-18">Activities involved</h5>
<div class="border-separator w-full"></div>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.</p>
</div>


<!--with an image-->
  <div class="content-container-img w-100">
  <img src='{{asset("storage/activities_images/thumbnails/".$Details[0]["filename"]) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->

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
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"> </span> OTHER MINISTRIES</a></h1><?php } ?>

<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini">
 
 @if(count($DataInfo) > 0) 
@foreach ($DataInfo as $info)
    <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/ministry/{{$info->id}}/{{Str::slug($info->headingtext)}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/activities_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/ministry/{{$info->id}}/{{Str::slug($info->headingtext)}}">{{$info->headingtext}}</a> 
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
<a href="/ministries" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">View all <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
<?php } ?>
</section>



    </div>
</section>



@endsection
<!--code above is for templating-->

