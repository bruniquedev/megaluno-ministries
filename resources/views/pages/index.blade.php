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


@if(count($HomeIntroData) > 0) 
@foreach ($HomeIntroData as $info1)
<!--tagline section-->
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container w-100 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content p-b-5p">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$info1->title}}</a></span></h1>

    <div class="border-separator m-0-auto w-40 m-t-10"></div>
 
<p class="center">{{$info1->description}}</p>

</div>
  </div> 
</div>
</div>
<!--/tagline section-->

@if(count($HomeIntro_detailsData) > 0) 
<!--summary section-->
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container home-summary-container w-100 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content p-t-5p">

<div class="home-summary flex">
@foreach ($HomeIntro_detailsData as $detail1)
@if($info1->id == $detail1->related_id) 
<div class="home-summary-item">
  <div class="summary_img_wrapper">
  <img src="<?php echo asset("storage/content_uploads/details/".$detail1->iconfilelist);?>" alt="img" class="summary_img" />
</div>
  <h1 class="f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$detail1->headinglist}}</a></span></h1>
<p>{{$detail1->descriptionlist}}</p>
</div>
@endif
@endforeach 
</div>
</div>
  </div> 
</div>
</div>
@endif
<!--/summary section-->
@endforeach 
@endif


@if(count($SermonsData) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-b-l b-r-b-r">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-3 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php echo Title_and_description("sermon")['heading']; ?></a></span></h1>
<p class="center m-b-30"><?php echo Title_and_description("sermon")['description']; ?></p>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">
@foreach ($SermonsData as $info2)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/sermon/{{$info2->id}}/{{$info2->slug}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/content_uploads/thumbnails/'.$info2->filename) }}" alt="">
       </div>
        <div class="thumbnail-caption">
            <h6 class="t-item-heading m-b-5 text-wrapping w-80">{{$info2->title}}</h6>
        </div>
    </a>
    <div class="t-content">
       <a class="t-description" href="javascript:void(0);"></a> 
        <div class="t-content-1">
 <div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/sermon/{{$info2->id}}/{{$info2->slug}}" class="btn-ui btn-ui-xs btn-ui-default more-btn-eui f-s-14">Read more..  <i class="ion ion-ios-arrow-right f-s-13 m-l-5"></i></a>
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
<a href="/sermons" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More sermons <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif





<!--about section-->
 @if($AboutinfoData)
    <div class="section_area">
<div class="aboutarea">
 <div class="about-container w-90 animate-element delay6 fadeInLeft-anime "> 
<div class="about-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php echo Title_and_description("about")['heading']; ?></a></span></h1>
    <div class="border-separator w-full m-t-10"></div>
<p><?php echo Title_and_description("about")['description']; ?></p>

  <div class="item-col">
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
<span><a href="javascript:void(0);" class="color-black">{{$AboutinfoData->title}}</a></span></h3>
<p class="">{{$AboutinfoData->description}}</p>

@if($About_detailsData) 
@if($AboutinfoData->id == $About_detailsData->related_id) 
@if($About_detailsData->headinglist)
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
<span><a href="javascript:void(0);" class="color-black">{{$About_detailsData->headinglist}}</a></span></h3> 
@endif
@if($About_detailsData->descriptionlist)
<p>{{$About_detailsData->descriptionlist}}</p>
@endif
@endif
@endif
</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/about" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">Read more <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</div>
  </div> 
</div>
</div>
@endif
<!--/about section-->



 @if($DataDonationsInfo) 
<!--about section-->
    <div class="section_area m-t-30">
<div class="aboutarea background-img pagecontainerarea bg-img-attachment" style="background-image: url('{{asset("storage/content_uploads/thumbnails/".$DataDonationsInfo->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content pagearea-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black"><span class=""><?php echo Title_and_description("donation")['heading']; ?></span> :</a></span></h1>

    <div class="border-separator w-full"></div>

<p class="center m-b-30"><?php echo Title_and_description("donation")['description']; ?></p>

<div class="flex justify-center align-items-center m-t-10">

  <div class="item-col">
    <div class="item-separator item-separator-grey h-200p"></div>
  </div>
  <div class="item-col">
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
<span><a href="javascript:void(0);" class="color-black">{{$DataDonationsInfo->title}}</a></span></h3>
<p class="">{{$DataDonationsInfo->description}}</p>

@if(count($Donation_detailsData) > 0) 
@foreach ($Donation_detailsData as $detail3)
@if($DataDonationsInfo->id == $detail3->related_id)
@if($detail3->headinglist)
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
<span><a href="javascript:void(0);" class="color-black">{{$detail3->headinglist}}</a></span></h3> 
@endif
@if($detail3->descriptionlist)
<p>{{$detail3->descriptionlist}}</p>
@endif
@endif
@endforeach 
@endif
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


<div class="background-img bg-img-attachment" style="background-image: url('{{asset("storage/content_uploads/thumbnails/".$AboutinfoData->filename) }}');"><!--bg attachment start-->
   
 @if(count($MinistriesData) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-t-l b-r-t-r">
 
  <h1 class="f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-1 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span> <?php echo Title_and_description("ministry")['heading']; ?></a></span></h1>

<p class="center m-b-30"><?php echo Title_and_description("ministry")['description']; ?></p>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">
 

@foreach ($MinistriesData as $info3)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/ministry/{{$info3->id}}/{{$info3->slug}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/content_uploads/thumbnails/'.$info3->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/ministry/{{$info3->id}}/{{$info3->slug}}">{{$info3->title}}</a> 
    </div>
</div>
</div>
  </div>
<!--item-->
@endforeach

</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/ministries" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">View more <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif 



 @if(count($InvolvementData) > 0) 
<section class="section_area m-t-20 p-5p bg-color-white">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-1 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span><?php echo Title_and_description("involvement")['heading']; ?></a></span></h1>
    <p class="center m-b-30"><?php echo Title_and_description("involvement")['description']; ?></p>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">

@foreach ($InvolvementData as $info4)
  <!--item-->
<div class="n-container-item">
  <a href="/involvement/{{$info4->id}}/{{$info4->slug}}" class="n-container-img">
  <img src="{{ asset('storage/content_uploads/thumbnails/'.$info4->filename) }}" alt="img" class="n-image img-fluid">
</a>
  <div class="n-content">
    <p class="text-wrapping w-80"><a href="/involvement/{{$info4->id}}/{{$info4->slug}}">{{$info4->title}}</a></p>
    <p class="text-wrapping w-80"><a href="/involvement/{{$info4->id}}/{{$info4->slug}}">
     <?php echo str_limit($info4->description, 10); ?></a></p>
  </div>
</div>
<!--item-->
@endforeach

</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/involvements" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">View More<i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</section>
@endif 


@if(count($Eventsinfodata) > 0) 
<section class="section_area m-t-20 bg-color-white p-5p b-r-b-l b-r-b-r">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-1 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><?php echo Title_and_description("event")['heading']; ?></a></span></h1>
    <p class="center m-b-30"><?php echo Title_and_description("event")['description']; ?></p>

<div class="flex justify-center  flex-wrap flex-grow section-row-content">
@foreach ($Eventsinfodata as $info5)
  <!--item-->
  <div class="col-item w-32 m-r-10">
    <div class="t-container">
<div class="t-item">
    <a href="/event/{{$info5->id}}/{{$info5->slug}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/content_uploads/thumbnails/'.$info5->filename) }}" alt="">
       </div>
        <div class="thumbnail-caption">
            <h6 class="t-item-heading m-b-5 text-wrapping w-80">{{$info5->title}}</h6>
            <small class="f-s-17 color-black-dark f-w-500 text-wrapping w-80"><?php echo str_limit($info5->description, 10); ?></small>
        </div>
    </a>
    <div class="t-content">
       <a class="t-description" href="javascript:void(0);"></a> 
        <div class="t-content-1">
 <div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/event/{{$info5->id}}/{{$info5->slug}}" class="btn-ui btn-ui-xs btn-ui-default more-btn-eui f-s-14">Read more..  <i class="ion ion-ios-arrow-right f-s-13 m-l-5"></i></a>
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



@if($GalleryinfoData) 
<!--about section-->
    <div class="section_area m-t-30">
<div class="aboutarea background-img pagecontainerarea bg-img-attachment h-500p b-r-1p" style="background-image: url('{{asset("storage/content_uploads/thumbnails/".$GalleryinfoData->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content fit-view pagearea-content bg-color-transparent flex justify-center align-items-center flex-wrap flex-grow w-100">

<div class="flex justify-center align-items-center m-t-15 m-b-15 w-full gallery-btn-container">
<a href="{{ route('gallery.index') }}" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui h-galley-btn">VIEW GALLERY <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>

</div>
  </div> 
</div>
</div>
@endif
<!--/about section-->





@if(count($TestimonialsData) > 0)
<section class="section_area m-t-20 testimonials-area">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-1 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span><?php echo Title_and_description("testimonial")['heading']; ?></a></span></h1>

    <p class="center m-b-30 tst-desc"><?php echo Title_and_description("testimonial")['description']; ?></p>

<div class="multi-carousel" data-seconds="10" id="MulticarouselTestimonials">
  <div class="row-multislider">
   <div class="row-multislider-container justify-center m-t-50 multislide-section">
 
@foreach ($TestimonialsData as $info6) 
  <!--item-->
        <div class="u-repeater-item-mb container-multislider w-25 p-t-50p">
              <div class="item-content-mb">
                <span class="u-icon-rectangle"><i class="ion ion-chatbubbles"></i></span>
                <h5 class="u-heading-mb-5"> {{$info6->heading}} </h5>
                <h5 class="u-heading-mb-pf">{{$info6->title}}</h5>
                <p class="u-text-mb text-style">{{$info6->description}}</p>
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

