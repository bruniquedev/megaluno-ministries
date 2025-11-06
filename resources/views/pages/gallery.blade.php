
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Gallery"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->descriptiontext)
@section('keywords',$SEODataInfo->keywordstext)
<?php } ?>
@endforeach
@endif
<!--/seo-->

@section('content') 

@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

 <section class="main-content-section w-full m-t-100 m-b-50">
    <div class="main-content-container">

<!--about section-->
    <div class="section_area">
   <div class="heading-bg bg-color-aliceblue h-50p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex justify-center align-items-center h-50p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"> GALLERY</a></span></h1>
    </div>
</div>
</div>
<!--/about section-->

<section class="slide_show_format_G">
<div class="slideshow-container_G" id="slideshow-container_G">

@if(count($DataInfo) > 0)
<?php $counter=0; ?>
<!--iterate through an array-->
@foreach($DataInfo as $Info)
<?php $counter++; ?>
<div class="mySlides_G fade_G">
  <div class="numbertext_G"><?php echo $counter."/".count($DataInfo); ?></div>
  <!--<div class="img_G" style="background-image: url('{{ asset("storage/gallery_images/thumbnails/".$Info->filename) }}');
    width:auto; height:500px;"></div>-->

  <div class="G-container-img">
  <img src="{{ asset('storage/gallery_images/thumbnails/'.$Info->filename) }}" alt="img" class="G-image img-fluid">
  </div>


  <div class="text_G">{{ucfirst($Info->text)}}</div>
</div>
@endforeach
@endif




  <!-- Next and previous buttons -->
  <a class="prev_G" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next_G" onclick="plusSlides(1)">&#10095;</a>

</div>
<br>

<div class="center">
  @if(count($DataInfo) > 0)
<?php $counter=0; ?>
<!--iterate through an array-->
@foreach($DataInfo as $Info)
<?php $counter++; ?>
  <span class="dot_G" onclick="currentSlide(<?php echo$counter; ?>)"></span>
  @endforeach
@endif
</div>
</section>


    </div>
</section>


@endsection
<!--code above is for templating-->

