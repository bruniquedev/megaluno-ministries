
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

 <section class="main-content-section w-full m-t-150 m-b-50">
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



 @if(count($DataInfo) > 0) 
<section class="section_area m-t-20 p-5p bg-color-white">

<div class="flex justify-center  flex-wrap flex-grow section-row-content">

@foreach ($DataInfo as $info)


  <!--item-->
<div class="n-container-item">
  <a href="javascript:void(0);" class="light-box-preview n-container-img"  data-images="<?php echo asset('storage/gallery_images/thumbnails/'.$info->filename); ?>" data-desc="<?php echo$info->text; ?>">
  <img src="{{ asset('storage/gallery_images/thumbnails/'.$info->filename) }}" alt="img" class="n-image img-fluid">
</a>
  <div class="n-content">
    <p class="text-wrapping w-80 color-white">
     <?php echo str_limit($info->text, 10); ?></p>
  </div>
</div>
<!--item-->
@endforeach

</div>
</section>
@endif 





    </div>
</section>


@endsection
<!--code above is for templating-->

