
    
<div class="navigation" id="navigation">


  <div class="nav-first">
   <div class="nav_brand">
  <div class="logo_wrapper" id="logobrand" logourl="{{'storage/logo_images/'.$Logoname }}" brandtext="{{$Brandname}}">
  <img src="<?php echo asset('storage/logos_images/'.$Logoname);?>" alt="logo" class="logo_img" />
</div>

   <div class="brand_text">
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
</div>

<div class="responsive-nav" id="responsive-nav">

   <ul class="menu-nav" id="menu-nav">

     <li><a href="{{ route('manage-visitors.index') }}">Visitors <?php if($TodayTotalCountvisitors > 0){ ?>  
      <span class="badge badges messagebadge" id="messagebadge" ><?php echo $TodayTotalCountvisitors; ?></span><?php } ?></a></li>

<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Home 
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
<li><a href="{{ route('manage-sliders.index') }}">Slider</a></li>
<li><a href="{{ route('manage-logos.index') }}">Logo management</a></li>
<li><a href="{{ route('manage-home.index') }}">Home management</a></li>
<li><a href="{{ route('manage-partnerlogos.index') }}">Partners management</a></li>

<li><a href="{{ route('manage-socialmedia.index') }}">Social media management</a></li>
<li><a href="{{ route('manage-seo.index') }}">SEO management</a></li>

{{--<!--<li><a href="{{ route('manage-areasserved.index') }}">Areas served</a></li>-->--}}
    </ul>
  </li> 
<!----end -dropdown---->


<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Ministries
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-ministries.create') }}">Create a ministry info</a></li>
<li><a href="{{ route('manage-ministries.index') }}">Ministries info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Involvement
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-involvements.create') }}">Create an involvement info</a></li>
<li><a href="{{ route('manage-involvements.index') }}">Involvements info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Sermons
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-sermons.create') }}">Create a sermon info</a></li>
<li><a href="{{ route('manage-sermons.index') }}">Sermons info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->


<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Programmes
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-programmes.create') }}">Create a programme info</a></li>
<li><a href="{{ route('manage-programmes.index') }}">Programmes info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Projects
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-projects.create') }}">Create project info</a></li>
<li><a href="{{ route('manage-projects.index') }}">Projects info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Events
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-events.create') }}">Create Event info</a></li>
<li><a href="{{ route('manage-events.index') }}">Events info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a href="javascript:void(0);" class="dropbtn">Donations 
<?php if(count($Unreaddonations) > 0){ ?>
      <span class="badge badges testsbadge" id="testsbadge" ><?php echo count($Unreaddonations); ?></span><?php } ?>  
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
 <li><a href="/users-donations">Visitors Donations
 <?php if(count($Unreaddonations) > 0){ ?> 
  <span class="badge badges testsbadge" id="testsbadge" ><?php echo count($Unreaddonations); ?></span> <?php } ?> 
</a></li>
<li><a href="{{ route('manage-donations.create') }}">Create donation info</a></li>
<li><a href="{{ route('manage-donations.index') }}">Donation info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

<!-----dropdown---->
  <li class="custom-dropdown">
    <a href="javascript:void(0);" class="dropbtn">Reviews 
<?php if(count($Unreadreviews) > 0){ ?>
      <span class="badge badges testsbadge" id="testsbadge" ><?php echo count($Unreadreviews); ?></span><?php } ?>  
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
 <li><a href="{{ route('manage-testimonials.index') }}">Testimonials
 <?php if(count($Unreadreviews) > 0){ ?> 
  <span class="badge badges testsbadge" id="testsbadge" ><?php echo count($Unreadreviews); ?></span> <?php } ?> 
</a></li>
    </ul>
  </li> 
<!----end -dropdown---->




<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">About
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-about.create') }}">Create about info</a></li>
<li><a href="{{ route('manage-about.index') }}">About info</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

{{--
<!-----dropdown---->
  <!--<li class="custom-dropdown">
    <a class="dropbtn">Services
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
  <li><a href="{{ route('manage-services.create') }}">Create a services</a></li>
<li><a href="{{ route('manage-services.index') }}">Services</a></li>
    </ul>
  </li>-->
<!----end -dropdown---->
--}}


<li><a href="{{ route('manage-gallery.index') }}">Gallery</a></li>


<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">Contacts
      <?php if(count($Unreadmessages) > 0){ ?>  
      <span class="badge badges messagebadge" id="messagebadge" ><?php echo count($Unreadmessages); ?></span><?php } ?> 
      <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
<li><a href="{{ route('manage-contact-setup.index') }}">Set up contacts</a></li>
<li><a href="{{ route('manage-contacts.index') }}">Contacts
<?php if(count($Unreadmessages) > 0){ ?>
  <span class="badge badges messagebadge" id="messagebadge" ><?php echo count($Unreadmessages); ?></span><?php } ?> 
</a></li>
    </ul>
  </li> 
<!----end -dropdown---->



<!-----dropdown---->
  <li class="custom-dropdown">
    <a class="dropbtn">others <i class="ion-android-arrow-dropdown"></i>
    </a>
    <ul class="custom-dropdown-content">
<li><a href="{{ route('manage-changepassword.index') }}">Change password</a></li>
<?php
if(Auth::user()->admintype=="Super admin"){
?>
<li><a href="{{ route('manage-admins.index') }}">Create admins</a></li>
<?php } ?>
<li><a href="/manage-logout">Log out</a></li>
    </ul>
  </li> 
<!----end -dropdown---->

  

</ul>



</div>
  <a href="javascript:void(0);" class="icon" onclick="DefaultNavFunction()">&#9776;</a>
</div>

 