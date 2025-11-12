
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


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container full-detail">

<!--about section-->
    <div class="section_area">

   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex flex-column justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo"All Sermons: ";}else{?> {{$title}} : Sermon <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->


<?php if($option=="details"){ ?>
    <!--about section-->
    <div class="section_area">
<div class="aboutarea pagecontainer-details-area"><!---->
 <div class="about-container more-details-container w-80 flex flex-column  flex-wrap flex-grow animate-element delay6 fadeInLeft-anime "> 

<!--with an image-->
  <div class="content-container-img w-100">
  <img src='{{asset("storage/events_images/thumbnails/".$Details[0]["filename"]) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
<!--with content-->
<div class="about-content p-0p pagearea-detail-content w-100">
  <h1 class="f-s-20 f-w-500 m-t-30 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark">Book of Psalms</a></span></h1>
    <h5 class="color-black-fading m-t-10 f-w-500 f-s-15 font-Myriad-regular">By Louis Kennedy | March 3, 2025</h5>
    <div class="border-separator w-full"></div>

<div class="head-description m-b-20">
<h5 class="m-t-10  f-w-500 f-s-18">John 3:14</h5>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.</p>
</div>

<div class="head-description m-b-20">
<h5 class="m-t-10 f-w-500 f-s-18">Jeremiah 1:30</h5>
<p>The believer struggling hard against shame needs to watch you exult, “My sin, not in part, but the whole, has been nailed to the cross, and I bear it no more!” The saint overburdened by work, striving, and performance needs to listen as you affirm, “We rest on Thee, our shield.”</p>
<p><span class="f-w-500 color-black-dark m-r-3 font-century-bold">Number 5:16</span> “For God so loved the world that he gave his one and only Son, that whoever believes in him shall not perish but have eternal life.</p> 
</div>

<div class="head-description m-b-20">
<p><span class="f-w-500 color-black-dark m-r-3 font-century-bold">1 Corinthians 13:4-8</span> Love is patient, love is kind. It does not envy, it does not boast, it is not proud.  It is not rude, it is not self-seeking, it is not easily angered, it keeps no record of wrongs.  Love does not delight in evil but rejoices with the truth.  It always protects, always trusts, always hopes, always perseveres.  Love never fails. But where there are prophecies, they will cease; where there are tongues, they will be stilled; where there is knowledge, it will pass away.</p>
</div>


<div class="head-description m-b-20" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
  <iframe 
    src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen>
  </iframe>
</div>


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
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="">OTHER SERMONS</span> :</a></span></h1><?php } ?>

<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini ">
 
 @if(count($DataInfo) > 0) 
@foreach ($DataInfo as $info)
    <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/sermon/{{$info->id}}/{{Str::slug($info->headingtext)}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/events_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/sermon/{{$info->id}}/{{Str::slug($info->headingtext)}}">{{$info->headingtext}}</a> 
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
<a href="/sermons" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More sermons <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
<?php } ?>
</section>



    </div>
</section>



@endsection
<!--code above is for templating-->

