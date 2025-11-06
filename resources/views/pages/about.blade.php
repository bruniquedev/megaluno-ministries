
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="About"){ 
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


 @if(count($AboutinfoData) > 0) 
@foreach ($AboutinfoData as $info)
<!--about section-->
    <div class="section_area m-b-10">
<div class="aboutarea background-img bg-img-attachment" style="background-image: url('{{ asset("storage/about_images/thumbnails/".$info->filename) }}');">
 <div class="about-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content">

  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$info->headingtext}}</a></span></h1>

    <div class="border-separator w-full"></div>
@if(count($About_detailsData) > 0)
@foreach($About_detailsData as $About_detail)
@if($About_detail->about_id==$info->id)
<p>{{$About_detail->description}}</p> 
@endif
@endforeach
@endif

</div>
  </div> 
</div>
</div>
<!--/about section-->
@endforeach
@endif


    </div>
</section>



@endsection
<!--code above is for templating-->

