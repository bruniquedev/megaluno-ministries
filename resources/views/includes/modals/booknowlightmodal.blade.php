      <!--pop-->

           <div class="popup-light-overlay" id="booknowpopup" >
              <div class="popup-light-body w-70">

         
             <div class="heading text-center">
<h2 class="heading_1 center animate-element delay6 fadeInDown-animation fadeInDown f-w-600 color-white">Let's get started with your booking</h2>
</div>
    <div class="border-separator w-full"></div>

    <form role="form" method="POST" action="{{route('userbooking.post')}}"   name="FORM_BOOKNOW" 
id="FORM_BOOKNOW" onsubmit="return User_booking_request(event);" class="animate-element delay4 fadeInLeftBig-animation fadeInLeftBig m-t-20"> 
        @csrf


<div class="form-groupy">
  <label for="name" id="Namelabel" class="color-white">Select package<span class="color-danger f-s-17">*</span></label>
<div class="search-form-container m-b-20 m-t-5">
<div id="searchBar" class="search-input-container-eui">
<input type="text" id="packagename" name="packagename" autocomplete="off" class="search-input-eui packagename-input" role="searchbox"  value="" placeholder="search package..." onkeyup="return DropdownfilterFunction('search-input-eui','search-form-results');">
<div class="search-close-icon"><i class="ion ion-close-circled"></i></div>
<div class="submit-search-eui"><i class="ion ion-search"></i></div>
</div>
  <ul class="custom-dropdown-content-eui search-form-results">
 @if(count($Datapackages) > 0) 
@foreach ($Datapackages as $info)
<li class="packages-btn" data-packageid="{{$info->packageid}}" data-package="{{$info->packagename.', '.$info->headingtext}}"><a href="#"><i class="ion ion-search"></i><span class="dropdown-item-text">{{$info->packagename.', '.$info->headingtext.' starts from '.$info->price.' USDs per person'}}</span></a></li>
@endforeach
@endif 
    </ul> 
</div>
</div>

<div class="flex flex-wrap">
  <div class="form-groupy w-31 m-r-5">
  <label for="name" id="Namelabel" class="color-white">Full name <span class="color-danger f-s-17">*</span></label>
  <div class="form-input-group m-t-5">    
  <input type="text" class="input-control" required="required"  name="Name" id="Name" />
</div>
</div>                           
 <div class="form-groupy w-31 m-r-5">
  <label for="name" id="Emailabel" class="color-white"> Email<span class="color-danger f-s-17">*</span></label>
  <div class="form-input-group m-t-5">    
  <input type="email" class="input-control" data-error="Bruh, that email address is invalid"  
  required="required" name="email" id="email" />
</div>
  <div class="help-block with-errors"></div>
    </div>
<div class="form-groupy w-31">
  <label for="name" id="phonelabel" class="color-white"> Phone number<span class="color-danger f-s-13 m-l-5">*</span></label>
  <div class="form-input-group m-t-5">    
  <input type="text" class="input-control" data-minlength="10"  data-error="Bruh, that Phone Number is invalid"
   name="phonenumber" id="phonenumber" required="required" />
 </div>
 <div class="help-block with-errors"></div>
    </div>
    </div> 
  
<div class="form-groupy">
<label for="name" id="MessageLabel" class="color-white">Additional details<span class="color-danger f-s-13 m-l-5">(Optional)</span></label>
<div class="form-input-group m-t-5"> 
<textarea class="input-control"  name="message" id="message" rows="2"></textarea>
</div>
</div>

<input type="hidden" id="selectedpackageid" name="packageid" value="0">
                          
 <div class="center"> 
 <button type="submit" name="submit" class="btn-ui btn-ui-lg btn-ui-pure-orange w-full b-r-9999999p" id="submitbutton" >SEND</button>
</div> 
                      </form>
              


              </div>
              <a class="close-popup-light" href="javascript:void(0);">×</a>
            </div>

          <!--/popup-->

        