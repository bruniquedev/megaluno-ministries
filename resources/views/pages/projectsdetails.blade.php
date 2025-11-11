
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Projects" && $option=="All"){ 
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
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo"All PROJECTS: ";}else{?> {{$title}} : Project <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->



<?php if($option=="details"){  //start of detail checking  ?>

<!--about section-->
    <div class="section_area m-t-10">
<div class="aboutarea background-img pagecontainerarea" style="background-image: url('{{ asset("storage/projects_images/thumbnails/".$Details[0]->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime"> 
<div class="about-content pagearea-content">

  <!--<h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-white"><span class="font-century-light">SNEAK PEEK</span> : UGANDA</a></span></h1>-->

    <div class="border-separator w-full"></div>


<div class="flex justify-center align-items-center m-t-10">

  <div class="item-col">
    <div class="item-separator item-separator-grey h-300p"></div>
  </div>
  <div class="item-col">
<h3 class="text-left f-s-18 animate-element delay6 fadeInDown-anime">
    <span><a href="javascript:void(0);" class="color-white">{{$title}}</a></span></h3>

 @if(count($detailItems) > 0) 
@foreach ($detailItems as $info)
<p>@if($info->heading!="") <span class="f-w-600 color-white m-r-3">{{$info->heading}} :</span> @endif
   {{$info->description}}</p> 
@endforeach
@endif 
</div>

</div>

</div>
  </div> 
</div>
</div>
<!--/about section-->


<!--about section-->
 <?php if($option=="details"){ ?>
 @if(count($DataDonationsInfo) > 0)
    <div class="section_area m-t-30">
<div class="aboutarea background-img pagecontainerarea bg-img-attachment" style="background-image: url('{{asset("storage/donations_images/thumbnails/".$DataDonationsInfo[0]->filename) }}');">
 <div class="about-container page-container animate-element delay6 fadeInLeft-anime "> 
<div class="about-content pagearea-content">

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


 @if(count($DataInfo) > 0) 
<section class="section_area m-t-20">
 
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading heading-underline">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span>OTHER PROJECTS</a></span></h1>

<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini ">
 
@foreach ($DataInfo as $info)
  <!--item-->
<div class="n-container-item">
  <a href="/project/{{$info->id}}/{{$info->headingtext}}" class="n-container-img">
  <img src="{{ asset('storage/projects_images/thumbnails/'.$info->filename) }}" alt="img" class="n-image img-fluid">
</a>
  <div class="n-content">
    <p class=""><a href="/project/{{$info->id}}/{{$info->headingtext}}">{{$info->headingtext}}</a></p>
    <p><a href="/project/{{$info->id}}/{{$info->headingtext}}">
     <?php echo str_limit($info->descriptiontext, 10); ?></a></p>
  </div>
</div>
<!--item-->
@endforeach 
</div>

<div class="flex justify-center align-items-center m-t-15 m-b-15">
<a href="/projects" class="btn-ui btn-ui-lg btn-ui-default more-btn-eui">More projects <i class="ion ion-ios-arrow-right f-s-17 m-l-5"></i></a>
</div>
</section>
@endif

<?php } //end of detail checking ?>





<?php if($option=="All"){ //start of All checking ?>

 @if(count($DataInfo) > 0) 
<section class="section_area m-t-20">
  <!--<h1 class="center f-s-25 animate-element delay6 fadeInDown-anime m-t-30 m-b-15 section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"><span class="font-century-light"></span>National parks</a></span></h1>-->
<div class="flex justify-center align-items-center flex-wrap flex-grow section-row-mini">
@foreach ($DataInfo as $info)
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
</section>
@endif

<?php } //end of All checking ?>




    </div>
</section>



@endsection
<!--code above is for templating-->

