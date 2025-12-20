
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->detail_type=="Testimonials"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->description)
@section('keywords',$SEODataInfo->heading)
<?php } ?>
@endforeach
@endif
<!--/seo-->

@section('content') 


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container">

<!--about section-->
    <div class="section_area">
   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"> What Other People Say</a></span></h1>
    </div>
</div>
</div>
<!--/about section-->

  @if(count($TestimonialsData) > 0)
  <div class="property-details-reviews  flex flex-wrap flex-grow">

 <!--iterate through an array-->
              @foreach($TestimonialsData as $review)
         <!--item 1-->
<div class="testimonial-column">
  <div class="testimonial-column-item">
    <div class="testimonail-content">
<p>{{$review->description}}</p>
    </div>

<div class="testimonial_item_triangle"></div>

<h4><strong>{{$review->heading}}</strong></h4>
<h5 class="color-black-fading">{{$review->title}}</h5>
  </div>

<div class="testimonial-img"><img  src="<?php echo asset('images/user.png');?>" alt="Carla Larson"></div>


</div>
        <!--/item 1-->
           @endforeach          

</div>

@endif 

    </div>
</section>


@endsection
<!--code above is for templating-->

