
@extends('layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

<!--seo-->
@if(count($SEOData) > 0)
@foreach($SEOData as $SEODataInfo)
<?php 
if($SEODataInfo->author=="Contact us"){ 
  ?>
@section('title',$SEODataInfo->title)
@section('description',$SEODataInfo->descriptiontext)
@section('keywords',$SEODataInfo->keywordstext)
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
  <h1 class="center f-s-25 animate-element delay6 fadeInDown-animation fadeInDown section-heading">
    <span><a href="javascript:void(0);" class="color-black-dark"> General Inquiries</a></span></h1>
    </div>
</div>
</div>
<!--/about section-->


<div class="flex flex-grow flex-wrap animate-element delay6 fadeInUp-animation fadeInUp">

<div class="col-box-item box-area-contact w-33">
<div class="box-simple">
  <div class="icon-outlined"><a href="#"> <i class="ion ion-ios-location"></i></a></div>
  
  
  @if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Address"){ 
  ?>
   <h3 class="h4"><a href="#">{{$ContactsSetupDataInfo->descriptiontext}}  {{$ContactsSetupDataInfo->addontext}} </a></h3>
  <?php  } ?>
@endforeach
@endif
</div>
</div>
<div class="col-box-item box-area-contact w-33">
<div class="box-simple">
  <div class="icon-outlined"><a href="#"> <i class="ion ion-ios-telephone"></i></a></div>
  @if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Tel"){ 
  ?>
   <h3 class="h4"><a href="tel:{{$ContactsSetupDataInfo->descriptiontext}}">
    {{$ContactsSetupDataInfo->descriptiontext}}  {{$ContactsSetupDataInfo->addontext}}</a></h3> 
  <?php  }
  if($ContactsSetupDataInfo->detailtype=="WhatsApp number"){
  ?>
    <h3 class="h4"><a href="{{$ContactsSetupDataInfo->addontext}}" target="_blank">
WhatsApp : {{$ContactsSetupDataInfo->descriptiontext}}</a></h3> 
  <?php  } ?>
@endforeach
@endif
</div>
</div>

<div class="col-box-item box-area-contact w-33">
<div class="box-simple">
  <div class="icon-outlined"><a href="#"> <i class="ion ion-ios-email"></i></a></div>
@if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Email"){ 
  ?>
   <h3 class="h4"><a href="mailto:{{$ContactsSetupDataInfo->descriptiontext}}">
    {{$ContactsSetupDataInfo->descriptiontext}}  {{$ContactsSetupDataInfo->addontext}} </a></h3>
  <?php  } ?>
@endforeach
@endif

</div>
</div>

</div>

<div class="flex flex-grow flex-wrap">

<div class="col-item col-box-item w-47 m-r-10">

<div class="heading text-center">
<h2 class="heading_1 center animate-element delay6 fadeInDown-animation fadeInDown f-w-500">Get in touch with us</h2>
</div>


<form role="form" method="POST" action="{{ route('usercontactmessage.post') }}"   name="FORM_CONTACT" 
id="FORM_CONTACT" onsubmit="return User_contactMessage_request(event);" class="animate-element delay4 fadeInLeftBig-animation fadeInLeftBig"> 
        @csrf

<div class="flex flex-wrap">
  <div class="form-groupy w-47 m-r-10">
  <label for="name">Full name <span class="color-danger f-s-17">*</span></label>
  <div class="form-input-group">    
  <input type="text" class="input-control" required="required"  name="Name" id="Name" />
</div>
</div>                           
 <div class="form-groupy w-47">
  <label for="name" id="Emailabel"> Email<span class="color-danger f-s-17">*</span></label>
  <div class="form-input-group">    
  <input type="email" class="input-control" required="required" name="email" id="email" />
</div>
  <div class="help-block with-errors"></div>
    </div> 
    </div> 
  
  <div class="form-groupy">
  <label for="name" id="phonelabel"> Phone number<span class="color-danger f-s-13 m-l-5">(Optional)</span></label>
  <div class="form-input-group">    
  <input type="text" class="input-control" name="phonenumber" id="phonenumber" />
 </div>
 <div class="help-block with-errors"></div>
    </div>

      <div class="form-groupy">
  <label for="name" id="Namelabel">Subject <span class="color-danger f-s-17">*</span></label>
  <div class="form-input-group">    
  <input type="text" class="input-control" required="required"  name="subject" id="subject" />
</div>
                          </div>

<div class="form-groupy">
<label for="name" id="MessageLabel">Message<span class="color-danger f-s-17">*</span></label>
<div class="form-input-group"> 
<textarea class="input-control" required="required" name="message" id="message" rows="3"></textarea>
</div>
<p style=" font-weight: bold; color:red; text-align:center;"><label id="charleft">
</div>
                          
 <div class="center"> 
 <button type="submit" name="submit" class="btn-ui btn-ui-lg btn-ui-skyblue w-full b-r-9999999p" id="submitbutton" >SEND</button>
</div> 
                      </form>




</div>

<div class="col-item col-box-item w-47 animate-element delay4 fadeInRightBig-animation fadeInRightBig">

<div class="heading text-center">
<h2 class="heading_1 center f-w-500">Map Location</h2>
</div>
<div class="map-responsive">
  @if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Map"){ 
  ?>
<?php echo$ContactsSetupDataInfo->descriptiontext; ?>
  <?php  } ?>
@endforeach
@endif
</div>

</div>

</div>






    </div>
</section>







@endsection
<!--code above is for templating-->

