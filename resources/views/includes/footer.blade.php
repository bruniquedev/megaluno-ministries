

@if(count($ContactsSetupData) > 0)
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="WhatsApp link"){ 
  ?>
  <a href="{{$ContactsSetupDataInfo->descriptiontext}}"  target="_blank" class="float_whatsApp_btn">
<i class="ion ion-social-whatsapp-outline my-float_whatsApp_btn"></i>
</a>
<?php } ?>
@endforeach
@endif


<footer id="footer" class="section_area">

	<div class="footer-content">
	   
	   <div class="first-footer">
			<div class="footer-inner-container p-15p">


        <!--row one-->
				<div class="flex flex-wrap flex-grow">

					
        		<div class="w-20 footer-blurb-item animate-element delay4 fadeInUp-anime">
						<h3><a id="footer-link" href="/about">About {{$Brandname}}</a></h3>
						     <ul id="ul-footeritem">
                @if(count($ContactsSetupData) > 0)
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Footer detail"){ 
  ?>
  <li class="w-85">{{$ContactsSetupDataInfo->descriptiontext}}</li>
<?php } ?>
@endforeach
@endif
						</ul>
					</div>



					<div class="w-15 footer-blurb-item animate-element delay6 fadeInUp-anime">
						<h3><a id="footer-link">QUICK LINKS</a></h3>
						     <ul id="ul-footeritem">
                        <li ><a id="link1" href="/">Home</a></li>
						    <li><a id="link1" href="/about">About us</a></li>
                <li ><a id="link1" href="/contactus">Contacts</a></li>
                <li><a href="{{ route('gallery.index') }}">Gallery</a></li>							
 <li><a id="link1" href="/testimonials">Testimonials</a></li>
               
						</ul>
					</div>





				
					 <div class="w-15 footer-blurb-item animate-element delay8 fadeInUp-anime">
						<h3 ><a id="footer-link" href="javascript:void(0);">OTHER LINKS</a></h3>
						<ul id="ul-footeritem">
<li><a href="/ministries">Ministries</a></li>					
 <li><a  href="/involvements">Get Involved</a></li>
 <li><a  href="/sermons">Sermons</a></li>
  <li><a  href="/events">Events</a></li>
  <li><a  href="/donate">Donate</a></li>
						</ul>
					</div>



					
						<div class="w-20 footer-blurb-item animate-element delay10 fadeInUp-anime">
						<h3 ><a id="footer-link" href="javascript:void(0);">SOCIAL LINKS</a></h3>
<p class="">
@if(count($SocialLinksData) > 0)
<!--iterate through an array-->
@foreach($SocialLinksData as $SocialLinksDataInfo)               		
<a class="navbar-brand-social-footer" href="{{$SocialLinksDataInfo->descriptiontext}}" target="_blank" > 
<i class="{{$SocialLinksDataInfo->socialtype}} ion"></i>
</a>
@endforeach
@endif
</p>
                          
					</div>






				   <div class="w-25 footer-blurb-item animate-element delay4 fadeInUp-anime">
					
          					<h3 ><a id="footer-link" href="/contactus">CONTACTS</a></h3>
<ul class="contact-footer-ul">
<li>{{$Brandname}}</li>
<!--iterate through an array-->
@if(count($ContactsSetupData) > 0)
<!--iterate through an array-->
@foreach($ContactsSetupData as $ContactsSetupDataInfo)
<?php 
if($ContactsSetupDataInfo->detailtype=="Address"){ 
  ?>
<li><i class="ion-ios-location"></i><a href="javascript:void(0);">{{$ContactsSetupDataInfo->descriptiontext}}</a></li>
<?php } ?>
<?php 
if($ContactsSetupDataInfo->detailtype=="Tel"){ 
  ?>
<li><i class="ion-ios-telephone"></i><a href="tel:{{$ContactsSetupDataInfo->descriptiontext}}">{{$ContactsSetupDataInfo->descriptiontext}}</a></li>
<?php } ?>
<?php 
if($ContactsSetupDataInfo->detailtype=="WhatsApp number"){ 
  ?>
<li><i class="ion ion-social-whatsapp-outline" style="font-size: 15px !important; width: auto;"></i><a href="{{$ContactsSetupDataInfo->addontext}}" target="_blank">{{$ContactsSetupDataInfo->descriptiontext}}</a></li>
<?php } ?>
<?php 
if($ContactsSetupDataInfo->detailtype=="Email"){ 
  ?>
<li style="color:#55acee !important;"><i class="ion-ios-email"></i><a style="color:#55acee !important;" href="mailto:{{$ContactsSetupDataInfo->descriptiontext}}">{{$ContactsSetupDataInfo->descriptiontext}}</a></li>
<?php } ?>
@endforeach
@endif
</ul>

				</div>
			
			</div>
			<!-- /.row -->		

         <!--row two-->
				<div class="row">
          <h3 class="center animate-element delay3 fadeInDown-anime"><a id="footer-link" href="javascript:void(0);">AFFILIATE PARTNERS</a></h3>

            <div class="partners justify-center flex-wrap flex flex-grow animate-element delay3 fadeInRightBig-anime">
						@if(count($PartnersData) > 0)
						@foreach($PartnersData as $PartnersDataInfo)
					   <div class="partner-logo">
            <div class="partner_logo_wrapper center">
              <img src="{{ asset('storage/partners_images/'.$PartnersDataInfo->filename) }}" alt="logo" class="partnerlogo_img img-responsive img-rounded"/>
             </div>
             <div class="partner-text center"><a href="{{$PartnersDataInfo->link}}" class="text_decoration" target="_blank">{{$PartnersDataInfo->text}}</a></div>
            </div>
						@endforeach
						@endif
           </div>


         </div>
     <!-- /.row 2 -->

        </div>
</div>
	   
	   
	  <?php	   
date_default_timezone_set('Africa/Kampala');
$Month= date('F, Y');
$Year=  date('Y');
	  ?>
	   
		<div class="second-footer">
			<div class="second-footer-container p-5p">
				<!---->
				<p id="copyrightpara"><i>Copyright &copy; {{$Brandname}}  <?php echo $Year; ?> </i></p>
				<div id="developerpara"><a href="mailto:bruniquedevelopers@gmail.com" class="color-black-dark">designed by bruniquedevelopers.com</div>
			</div>
		</div> <!---end of second-footer---->

	</div>
	</footer>	
