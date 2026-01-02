
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->detail_type=="Sermon" && $option=="All"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->description)
@section('keywords',$SEODataInfo->heading)
<?php }else if($option=="details"){ ?>

@section('title',$Details->title)
@section('description',$Details->description)
@section('keywords',$Details->title)

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
    <span><a href="javascript:void(0);" class="color-black-dark"><?php if($option=="All"){echo$title;}else{?> {{$title}} : Sermon <?php } ?></a></span></h1>
    </div>

</div>
</div>
<!--/about section-->

 <?php if($option=="All"){?>
    <p class="center m-b-30 f-s-17 text-para"><?php echo Title_and_description("sermon")['description']; ?></p><?php } ?>



<?php if($option=="details"){ ?>
    <!--about section-->
    <div class="section_area">
<div class="aboutarea pagecontainer-details-area"><!---->
 <div class="about-container more-details-container w-80 flex flex-column  flex-wrap flex-grow animate-element delay6 fadeInLeft-anime "> 

 @if($Details->filename)
<!--with an image-->
  <div class="content-container-img w-100">
  <img src='{{asset("storage/content_uploads/thumbnails/".$Details->filename) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
@endif

<!--with content-->
<div class="about-content p-0p pagearea-detail-content w-100">
  @if($Details->heading)
  <h1 class="f-s-20 f-w-500 m-t-30 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$Details->heading}}</a></span></h1>
   @endif


@if($Details->publisher || $Details->day_date)
    <h5 class="color-black-fading m-t-10 f-w-500 f-s-15 font-Myriad-regular">{{$Details->publisher}} <span>|</span> {{$Details->day_date}}</h5>
    <div class="border-separator w-full"></div>
    @endif


@if($Details->description)
  <div class="head-description m-b-20">
<p>{{$Details->description}}</p>
</div>
@endif

@if(count($detailItems) > 0)
@foreach($detailItems as $info_detail)
@if($info_detail->related_id==$Details->id)

@if($info_detail->titlelist || $info_detail->descriptionlist)
<div class="head-description m-b-20">


@if($info_detail->titlelist)
<h5 class="m-t-10 f-w-500 f-s-18">{{$info_detail->titlelist}}</h5>
@endif


@if($info_detail->descriptionlist)

@if($info_detail->headinglist=="")
<p>{{$info_detail->descriptionlist}}</p>
@else
@if($info_detail->headinglist)
<p>
  <span class="f-w-500 color-black-dark m-r-3 font-century-bold">{{$info_detail->headinglist}}</span> 
@if($info_detail->descriptionlist)
{{$info_detail->descriptionlist}}
@endif
</p>
@endif
@endif

@endif


</div>
@endif



@if($info_detail->filenamelist)
<!--with an image-->
  <div class="content-container-img w-100 m-b-20">
  <img src='{{asset("storage/content_uploads/details/thumbnails/".$info_detail->filenamelist) }}' alt="img" class="about-img img-fluid">
  </div>
<!--/with an image-->
@endif

@if($info_detail->video_filelist)
<div class="head-description m-b-30" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
  <iframe 
    src="{{$info_detail->video_filelist}}" 
    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
    frameborder="0"
    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
    allowfullscreen>
  </iframe>
</div>
@endif

@endif
@endforeach
@endif

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
    <a href="/sermon/{{$info->id}}/{{$info->slug}}" class="t-item-content">
       <div class="t-thumbnail">
        <img class="img-fluid" src="{{ asset('storage/content_uploads/thumbnails/'.$info->filename) }}" alt="">
       </div>
    </a>
    <div class="t-content">
       <a class="t-description text-wrapping w-80" href="/sermon/{{$info->id}}/{{$info->slug}}">{{$info->title}}</a> 
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

