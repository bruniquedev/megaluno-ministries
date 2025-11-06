@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->


<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Home"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->descriptiontext)
@section('keywords',$SEODataInfo->keywordstext)
<?php } ?>
@endforeach
@endif
<!--/seo-->



@section('content') 

<?php //var_dump(session('cart_items')); ?>

@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif


     <!-- Slider -->
      @include('includes.custom_slider_relative')
     <!-- end slider -->
 

  
 <section class="main-content-section home w-full m-b-20">
    <div class="main-content-container">



<!--tagline section-->
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container w-100 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content p-b-5p">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">Megaluna, Magnifying Christ</a></span></h1>

    <div class="border-separator m-0-auto w-40 m-t-10"></div>
 
<p class="center">Let the one among you who is without sin be the first to cast a stone.</p>

</div>
  </div> 
</div>
</div>
<!--/tagline section-->



<!--summary section-->
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container w-100 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content p-t-5p">

<div class="home-summary flex">

<div class="home-summary-item">
  <div class="summary_img_wrapper">
  <img src="<?php echo asset('images/user.png');?>" alt="img" class="summary_img" />
</div>
  <h1 class="f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">Our Causes Needs You</a></span></h1>
<p>Phasellus iaculis posuere velit, congue placerat duawi rhoncus vel. Maecenas tortor orci, aliquet..</p>
</div>

<div class="home-summary-item">
  <div class="summary_img_wrapper">
  <img src="<?php echo asset('images/user.png');?>" alt="img" class="summary_img" />
</div>
  <h1 class="f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">We Care About Causes</a></span></h1>
<p>Phasellus iaculis posuere velit, congue placerat duawi rhoncus vel. Maecenas tortor orci, aliquet.</p>
</div>

<div class="home-summary-item">
  <div class="summary_img_wrapper">
  <img src="<?php echo asset('images/user.png');?>" alt="img" class="summary_img" />
</div>
  <h1 class="f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">Our Church Is Growing</a></span></h1>
<p>Phasellus iaculis posuere velit, congue placerat duawi rhoncus vel. Maecenas tortor orci, aliquet.</p>
</div>

<div class="home-summary-item">
  <div class="summary_img_wrapper">
  <img src="<?php echo asset('images/user.png');?>" alt="img" class="summary_img" />
</div>
  <h1 class="f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">Get Involved</a></span></h1>
<p>Phasellus iaculis posuere velit, congue placerat duawi rhoncus vel. Maecenas tortor orci, aliquet.</p>
</div>


</div>


</div>
  </div> 
</div>
</div>
<!--/summary section-->


@if(count($Eventsinfodata) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-b-l b-r-b-r">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"> Sermons</a></span></h1>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">
@foreach ($Eventsinfodata as $info)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/event/{{$info->id}}/{{$info->headingtext}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/events_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
        <div class="thumbnail-caption">
            <h6 class="t-item-heading m-b-5 text-wrapping w-80">{{$info->headingtext}}</h6>
        </div>
    </a>
    <div class="t-content">
       <a class="t-description" href="javascript:void(0);"></a> 
        <div class="t-content-1">
 <div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/event/{{$info->id}}/{{$info->headingtext}}" class="btn-ui btn-ui-xs btn-ui-default more-btn-eui f-s-14">Read more..  <i class="ion ion-ios-arrow-right f-s-13 m-l-5"></i></a>
</div>
        </div>
    </div>
</div>
</div>
  </div>
<!--item-->
@endforeach 
</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/events" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More sermons <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif





<!--about section-->
 @if(count($AboutinfoData) > 0) 
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container w-90 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$AboutinfoData[0]->headingtext}}</a></span></h1>

    <div class="border-separator w-full m-t-10"></div>
@foreach ($About_detailsData as $info) 
<p>{{$info->description}}</p>
@endforeach


<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/about" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">Read more <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endif
<!--/about section-->



 @if(count($DataDonationsInfo) > 0) 
<!--about section-->
    <div class="section_area m-t-30">
<div class="aboutarea background-img sneekpeekarea bg-img-attachment" style="background-image: url('{{asset("storage/donations_images/thumbnails/".$DataDonationsInfo[0]->filename) }}');">
 <div class="about-container sneekpeek-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content sneekpeek-content">

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
<a href="/donate" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui donate-btn">Donate <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endif
<!--/about section-->


<div class="background-img bg-img-attachment" style="background-image: url('{{asset("storage/donations_images/thumbnails/".$DataDonationsInfo[0]->filename) }}');"><!--bg attachment start-->
   
 @if(count($Activitiesinfodata) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-t-l b-r-t-r">
 
  <h1 class="f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light">PROGRAMMES</span> HIGHLIGHTS</a></span></h1>


<div class="flex justify-center  flex-wrap flex-grow section-row-content">
 

@foreach ($Activitiesinfodata as $info)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/programme/{{$info->id}}/{{$info->headingtext}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/activities_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/programme/{{$info->id}}/{{$info->headingtext}}">{{$info->headingtext}}</a> 
    </div>
</div>
</div>
  </div>
<!--item-->
@endforeach

</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/programmes" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More Programmes <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif 


 @if(count($Projectsinfodata) > 0) 
<section class="section_area m-t-20 p-5p bg-color-white">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span>PROJECTS HIGHLIGHTS</a></span></h1>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">

@foreach ($Projectsinfodata as $info)
  <!--item-->
<div class="n-container-item">
  <a href="/project/{{$info->id}}/{{$info->headingtext}}" class="n-container-img">
  <img src="{{ asset('storage/projects_images/thumbnails/'.$info->filename) }}" alt="img" class="n-image img-fluid">
</a>
  <div class="n-content">
    <p class="text-wrapping w-80"><a href="/project/{{$info->id}}/{{$info->headingtext}}">{{$info->headingtext}}</a></p>
    <p class="text-wrapping w-80"><a href="/project/{{$info->id}}/{{$info->headingtext}}">
     <?php echo str_limit($info->descriptiontext, 10); ?></a></p>
  </div>
</div>
<!--item-->
@endforeach

</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/projects" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More projects<i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif 


@if(count($Eventsinfodata) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-b-l b-r-b-r">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"> EVENTS HIGHLIGHTS</a></span></h1>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">
@foreach ($Eventsinfodata as $info)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/event/{{$info->id}}/{{$info->headingtext}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/events_images/thumbnails/'.$info->filename) }}" alt="">
       </div>
        <div class="thumbnail-caption">
            <h6 class="t-item-heading m-b-5 text-wrapping w-80">{{$info->headingtext}}</h6>
            <small class="f-s-17 color-black-dark f-w-500 text-wrapping w-80"><?php echo str_limit($info->descriptiontext, 10); ?></small>
        </div>
    </a>
    <div class="t-content">
       <a class="t-description" href="javascript:void(0);"></a> 
        <div class="t-content-1">
 <div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/event/{{$info->id}}/{{$info->headingtext}}" class="btn-ui btn-ui-xs btn-ui-default more-btn-eui f-s-14">Read more..  <i class="ion ion-ios-arrow-right f-s-13 m-l-5"></i></a>
</div>
        </div>
    </div>
</div>
</div>
  </div>
<!--item-->
@endforeach 
</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/events" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More events <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif

</div><!--bg attachment end-->


@if(count($TestimonialsData) > 0)
<section class="section_area m-t-20">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span>TESTIMONIALS</a></span></h1>

<div class="multi-carousel" data-seconds="0" id="MulticarouselTestimonials">
  <div class="row-multislider">
   <div class="row-multislider-container justify-center m-t-50 multislide-section">
 
@foreach ($TestimonialsData as $info) 
  <!--item-->
        <div class="u-repeater-item-mb container-multislider w-25">
              <div class="item-content-mb">
                <span class="u-icon-rectangle"><i class="ion ion-chatbubbles"></i></span>
                <h5 class="u-heading-mb-5"> {{$info->name}} </h5>
                <p class="u-text-mb">{{$info->descriptiontext}}.</p>
                <a href="#"><span class="u-icon-mb"><i class="ion ion-quote"></i></span></a>
              </div>
            </div>
<!--item-->
@endforeach

<a href="javascript:void(0);" class="multisliderbtn left-controlbtn" id="left-controlbtn"><i class="ion-android-arrow-dropleft-circle  multislider-nav-icon" aria-hidden="true"></i></a>
<a href="javascript:void(0);" class="multisliderbtn right-controlbtn" id="right-controlbtn"><i class="ion-android-arrow-dropright-circle  multislider-nav-icon" aria-hidden="true"></i></a>
    <div class="clear"></div>
    </div>
    </div>
    <div class="clear"></div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/testimonials" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More testimonials<i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</div>


</section>
@endif









 </div>
    </section>


@endsection
<!--code above is for templating-->

