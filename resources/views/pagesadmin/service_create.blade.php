@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-100 m-b-50" >
 <div class="row justify-content-center"> 	
 <div class="col-md-12 col-md-12">
<!--<h1>Invoice and quotation</h1>-->
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<!--start-->


<div class="content-contain">




@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-services.store') }}" name="FORM" class="service-form" id="service-form" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-services.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  
      <div class="load-animate animated fadeInUp">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <h2 class="h2-title">Save / Create a service</h2> 
            </div>               
         </div>


  <div class="row">

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="form-groupy">
                  <label for="text">service name </label>
                   <div class="form-input-group"> 
                  <input type="text" class="input-control" name="name" id="name"  value="<?php echo $DataToEdit['name']; ?>" autocomplete="off">
               </div>
               </div>
            </div> 


             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-groupy">
                  <label for="text">Service heading </label>
                   <div class="form-input-group"> 
                  <textarea class="input-control" rows="2" name="heading" id="heading" ><?php echo $DataToEdit['heading']; ?></textarea>
               </div>
               </div>
            </div>  

             <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">

               <div class="form-groupy">
               <div class="input_label">Add image</div>
               <!--upload field one-->
               <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
               <i class="ion ion-upload left"></i>  
               Select<input type="file" name="service_image"  id="imagefile" class="text-bold">
               </span>
               <!--/upload field one-->
               </div>

               <div id="custom-img" style="background-image: url('{{ asset("storage/service_images/".$DataToEdit['filename']) }}'); width:40px;height:40px;"></div>
            </div>   

            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="form-groupy">
                  <label for="text">Image width</label>
                   <div class="form-input-group"> 
                  <input type="number" class="input-control" name="widthsize" id="widthsize"  value="<?php echo $DataToEdit['widthsize']; ?>" autocomplete="off">
               </div>
               </div>
            </div> 
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="form-groupy">
                  <label for="text">Image height </label>
                   <div class="form-input-group"> 
                  <input type="number" class="input-control" name="heightsize" id="heightsize"  value="<?php echo $DataToEdit['heightsize']; ?>" autocomplete="off">
               </div>
               </div>
            </div> 
         
                                                 
        
         </div>

       

        

   <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <h2 class="h2-title">Service details</h2> 
            </div>               
         </div>

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="table-container" id="servicedetailItem"> 
                  <tr>
                     <th width="2%"><input id="checkAllservice_detail" class="formcontrol" type="checkbox"></th>
                     <th width="98%">Description</th>
                  </tr>  
                     <?php  ?>
                  <?php  if(count($servicedetailItems)<=0){ ?>                 
                  <tr>
                     <td><input class="itemRow_servicedetail" type="checkbox"></td>
                   
                     <td>
                      <div class="form-groupy">
                  <label for="text">Service description</label>
                  <div class="form-input-group">
    <textarea class="input-control" rows="2" name="servicedescription[]" id="servicedescription_1" ></textarea></div>
                       </div>
                     </td>  
                   
                  </tr> 

<?php  }else{
$count = 0;
if(count($servicedetailItems) > 0){
foreach($servicedetailItems as $servicedetailItem){
$count++;
 ?>

 <tr>
                     <td><input class="itemRow_servicedetail" type="checkbox"></td>

                     <td>
                      <div class="form-groupy ">
                  <label for="text">Service description</label>
                  <div class="form-input-group">
                <textarea class="input-control" rows="2" name="servicedescription[]" id="servicedescription_<?php echo $count; ?>" autocomplete="off"><?php echo $servicedetailItem->description; ?></textarea>
                </div>
                       </div>
                     </td>

                                   
                  </tr> 


<?php 
}
}
} ?>



               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <button class="btn btn-danger delete" id="removeRows_servicedetails" type="button"><i  class="ion-android-delete"></i> Delete</button>
               <button class="btn btn-success" id="addRows_servicedetail" type="button"><i  class=" ion-plus"></i> Add More</button>
            </div>
         </div>


         <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              
              <div class="center">
            
               <div class="form-groupy">
                  <input type="hidden" value="<?php echo $DataToEdit['id']; ?>" class="form-control" name="serviceid" />
                  <button  type="submit" class="btn btn-success submit_btn service-save-btm"><i  class="ion-android-add-circle"></i> Save </button>                
               </div>
               </div>
               
            </div>
        
         </div>
         <div class="clearfix"></div>              
      </div>
   </form>  

</div>





<!--end-->






</div>
	   </div><!---end row-->
	    </div>



@endsection
<!--code above is for templating-->