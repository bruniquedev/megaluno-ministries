
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->
<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Testimonials"){ 
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

<!--about section-->
    <div class="section_area">
   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"> Testimonials</a></span></h1>
    </div>
</div>
</div>
<!--/about section-->

  
  <div class="property-details-reviews  flex flex-wrap flex-grow">

<!--col 1-->

 @if(count($TestimonialsData) > 0)
<div class="reviews-col-1">
<div class="property-reviews reviews-container" id="product-reviews-container" data-items="3">

           <!--iterate through an array-->
              @foreach($TestimonialsData as $review)
         <!--item 1-->
         <div class="single-review">
                          <div class="review-heading">
                            <div><a href="#"><i class="ion ion-android-person"></i>  {{$review->name}}  </a></div>
                            <div><a href="#"><i class="ion ion-clock"></i>  {{$review->reviewdate}}</a></div>
                            <div class="review-rating">
                               <?php if($review->ratings > 0){ 
                              for($i=1;$i<=$review->ratings; $i++){
                              ?>   
                          <i class="ion ion-android-star"></i>
                          <?php } 
                          for($i=1;$i<=5-$review->ratings; $i++){   
                          echo '<i class="ion ion-android-star-outline empty"></i>';
                            }
                          } ?>
                            </div>
                          </div>
                          <div class="review-body">
                            <p>{{$review->descriptiontext}}.</p>
                          </div>
                        </div>
                        <!--/item 1-->
                      @endforeach

            
                       <ul class="reviews-pages">
<li><a href="javascript:void(0);"  class="btn_prev_review"><i class="ion ion-arrow-left-a"></i></a></li>
  <!--<li class="active">1</li>
  <li><a href="#">2</a></li>-->
  <li><span class="page_review"></span></li>
  <li><a href="javascript:void(0);"  class="btn_next_review"><i class="ion ion-arrow-right-a"></i></a></li>
</ul>

            </div>
            </div> 
            <!--/col 1--> 
            @endif 

            <!--col 2-->
             
                 @if(count($TestimonialsData) > 0)
                    <div class="reviews-col-2">
                    @endif
                    @if(count($TestimonialsData) <= 0)
                   <div class="reviews-col-full w-full">
                    @endif


                       <h4 class="text-uppercase review-heading m-l-10">WRITE YOUR REVIEW</h4>
                      <p class="review_text_notif m-l-10 m-t-10 m-b-10">Your email address will not be published.</p>

                        @if (session('success'))
            <div class="m-l-10 m-t-10 m-b-10 alert-ui alert-success-ui">
{{ session('success') }}
                </div>
              @endif

                      <form method="POST" class="review-form" action="{{ route('userTestimonial.post') }}" id="review-form">
                        @csrf
                        <div class="form-groupy">
                        <div class="form-input-group">
                          <input class="input-control" type="text" required="required" placeholder="Your Name" name="reviewername" id="reviewername" />
                        </div>
                      </div>
                      <div class="form-groupy">
                        <div class="form-input-group">
                          <input class="input-control" type="email" placeholder="Email Address" name="reviewemail" id="reviewemail" required="required" />
                        </div>
                      </div>
                      <div class="form-groupy">
                        <div class="form-input-group">
                          <textarea class="input-control" placeholder="Your review" name="reviewmessage" id="reviewmessage" required="required"></textarea>
                        </div>
                      </div>

            
                        <div class="form-groupy">
      <div class="input-rating flex align-items-center">
        <strong class="text-uppercase f-w-500 f-s-17 m-r-10">Rank Blessing heart with stars : </strong>
        <div class="stars">
          <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
          <input type="radio" id="star4" name="rating" value="4"><label for="star4" ></label>
          <input type="radio" id="star3" name="rating" value="3"><label for="star3" ></label>
          <input type="radio" id="star2" name="rating" value="2" checked><label for="star2" ></label>
          <input type="radio" id="star1" name="rating" value="1" checked><label for="star1" ></label>
        </div>
      </div>
    </div>


                        <div class="form-groupy">
                        <div class="form-input-group">
                        <button type="submit" class="review-submit-btn btn-ui-dark w-full b-r-9999999p">Submit</button>
                         </div>
                       </div>
                      </form>




                     </div>

            <!--/col 2-->         



</div>



    </div>
</section>


@endsection
<!--code above is for templating-->

