
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->


@section('content') 


 <section class="main-content-section w-full m-t-150 m-b-50">
    <div class="main-content-container">

<!--about section-->
    <div class="section_area">

   <div class="heading-bg bg-color-aliceblue h-90p m-b-10">
    <div class="heading-bg-content bg-color-aliceblue flex flex-column justify-center align-items-center h-90p">
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-anime section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark">{{$title}}</a></span></h1>
    </div>

</div>
</div>
<!--/about section-->



    <!--about section-->
    <div class="section_area">
<div class="aboutarea pagecontainer-details-area"><!---->
 <div class="about-container more-details-container flex justify-center flex-wrap flex-grow "> 
<!--with content-->
<div class="about-content pagearea-detail-content w-100 completedonation-detail-page">


<!--some page content here-->
<div>
    <iframe src="<?php echo $Data->redirect_url; ?>" height="800" width="100%" title="Donation Iframe"></iframe>
</div>
<!--other page content here-->

</div>
<!--/with content-->
  </div> 
</div>
</div>
<!--/about section-->

    </div>
</section>



@endsection
<!--code above is for templating-->

