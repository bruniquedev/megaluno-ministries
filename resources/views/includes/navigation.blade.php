
    <!--navigation-transparent-->
   <?php $transparent_option=""; ?>
    @if (request()->routeIs('index'))
    <?php $transparent_option=" navigation-transparent"; ?>
    @endif
<div class="navigation <?php echo $transparent_option; ?>" id="navigation">

      <div class="first-section">

<div class="nav-first">

<div class="nav_brand">
  <div class="logo_wrapper" id="logobrand" logourl="{{'storage/content_uploads/icons/'.$LogoIcon }}" brandtext="{{$Brandname}}">
  <img src="{{ asset('storage/content_uploads/icons/'.$LogoIcon) }}" alt="logo" class="logo_img" />
</div>

   <div class="brand_text font-century-bold">
  <?php if(str_word_count($Brandname) > 1 && str_word_count($Brandname) ==2){
      $words = explode(" ", $Brandname);//break down the string
// $account_name = strtolower($words[0].'-'.$words[1]);//reconstruct into small words
    echo$words[0].'<span class="lohny"> '.($words[1])[0].'</span>'.substr($words[1], 1); //get the rest of the string
   }else{
   echo$Brandname;
   }
   ?>
</div>
</div>


<div class="nav_social_brands flex flex-wrap justify-right align-items-center" id="nav_social_brands">

@if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
<?php $counter=0; ?>
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detail_type=="Email"){ 
   $counter++;
   if($counter==1){
  ?>
  <a class="navbar-brand-social-header" 
  id="link1_email" href="mailto:{{$ContactsSetupDataInfo->description}}"> 
  <i class=" ion-socials ion-ios-email"></i>{{$ContactsSetupDataInfo->description}} </a>
  <?php } } ?>
@endforeach
@endif

@if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detail_type=="Tel"){ 
  ?>
  <a class="navbar-brand-social-header" id="link1_phone" href="tel:{{$ContactsSetupDataInfo->description}}"> <i class=" ion-socials ion-ios-telephone"></i>{{$ContactsSetupDataInfo->description}}</a>
  <?php } ?>
@endforeach
@endif
  

@if(count($SocialLinksData) > 0)
<!--iterate through an array-->
@foreach($SocialLinksData as $SocialInfo)
<a class="navbar-brand-social-header" title="{{$SocialInfo->title}}" href="{{$SocialInfo->description}}" target="_blank" > 
    <img class="img-contain w-30p" src='{{ asset("storage/content_uploads/icons/".$SocialInfo->iconfile) }}' />
 </a>
@endforeach
@endif

</div>
</div>

<div class="responsive-nav" id="responsive-nav">

   <ul class="menu-nav" id="menu-nav">

     <li ><a href="/"><i class="ion ion-home"></i> Home</a></li>

<li ><a href="/about"><i class="ion ion-information-circled"></i> About</a></li>
   
 

   <!-----dropdown---->
<li  class="custom-dropdown">
  <a href="/ministries" class="dropbtn">
<i class="ion ion-drag"></i> Ministries<i class="m-l-3 ion-ios-arrow-down"></i></a>
    <ul class="custom-dropdown-content">
@if(count($MinistriesInfoData) > 0) 
@foreach ($MinistriesInfoData as $info)
<li><a  href="/ministry/{{$info->id}}/{{$info->slug}}"><i class="ion ion-ios-arrow-forward"></i> {{$info->title}}</a></li>
@endforeach
@endif  
    </ul>
</li>
<!-----/dropdown---->

  <!-----dropdown---->
<li  class="custom-dropdown">
  <a href="/involvements" class="dropbtn">
<i class="ion ion-android-favorite-outline"></i> Get Involved<i class="m-l-3 ion-ios-arrow-down"></i></a>
    <ul class="custom-dropdown-content">
@if(count($InvolvementInfoData) > 0) 
@foreach ($InvolvementInfoData as $info) 
<li><a  href="/involvement/{{$info->id}}/{{$info->slug}}"><i class="ion ion-ios-arrow-forward"></i> {{$info->title}}</a></li>
@endforeach
@endif 
    </ul>
</li>
<!-----/dropdown---->

<li ><a href="/sermons"><i class="ion ion-android-bulb"></i> Sermons</a></li>


<li ><a href="/events"><i class="ion ion-android-calendar"></i> Events</a></li>


     <li ><a href="/testimonials"><i class="ion ion-android-star-outline"></i> Testimonials</a></li>
     <li><a href="{{ route('gallery.index') }}"><i class="ion ion-ios-photos"></i> Gallery</a></li>
     <li ><a href="/contactus"><i class="ion ion-ios-telephone"></i> Contacts</a></li>

     <li class="donate-btn"><a href="/donate">
<i class="ion ion-arrow-right-a"></i> Donate
</a></li>

</ul>
</div>

      </div>
  <a href="javascript:void(0);" class="icon" onclick="DefaultNavFunction(this)">&#9776;</a>
</div>

 