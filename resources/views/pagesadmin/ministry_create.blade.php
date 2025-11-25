@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-100 m-b-50" >
 <div class="row justify-content-center"> 	
 <div class="col-md-12 col-md-12">
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
@endif

<!--start-->


<div class="content-contain">




@if(!isset($DataToEdit['id']) || $DataToEdit['id']==0)
    <form role="form" method="post" action="{{ route('manage-about.store') }}" name="FORM" class="about-form" id="about-form" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-about.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  
      <div class="load-animate animated fadeInUp">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <h2 class="h2-title">Save / Create ministry info</h2> 
            </div>               
         </div>


  <div class="row">

           
             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-groupy">
                  <label for="text">About heading </label>
                  <div class="form-input-group">
                  <textarea class="form-control input_box_borderless" rows="2" name="heading" id="heading" ><?php echo $DataToEdit['headingtext']; ?></textarea>
               </div>
               </div>
            </div>  

             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

               <div class="form-groupy">
               <div class="input_label">Add image</div>
               <!--upload field one-->
               <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
               <i class="ion ion-upload left"></i>  
               Select<input type="file" name="input_image"  id="imagefile" class="text-bold">
               </span>
               <!--/upload field one-->
               </div>

               <div id="custom-img" style="background-image: url('{{ asset("storage/about_images/".$DataToEdit['filename']) }}'); width:40px;height:40px;"></div>
            </div>  
            
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="form-groupy">
                  <label for="text">Image width</label>
                  <div class="form-input-group">
                  <input type="number" class="form-control input_box_borderless" name="widthsize" id="widthsize"  value="<?php echo $DataToEdit['widthsize']; ?>" autocomplete="off">
               </div>
               </div>
            </div> 
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <div class="form-groupy">
                  <label for="text">Image height </label>
                  <div class="form-input-group">
                  <input type="number" class="form-control input_box_borderless" name="heightsize" id="heightsize"  value="<?php echo $DataToEdit['heightsize']; ?>" autocomplete="off">
               </div>
               </div>
            </div> 
         
                                                 
        
         </div>

       

        

   <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <h2 class="h2-title">About details</h2> 
            </div>               
         </div>

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="table-container" id="detailItem"> 
                  <tr>
                     <th width="2%"><input id="checkAll_detail" class="formcontrol" type="checkbox"></th>
                     <th width="30%">Heading</th>
                     <th width="68%">Description</th>
                  </tr>  
                     <?php  ?>
                  <?php  if(count($detailItems)<=0){ ?>                 
                  <tr>
                     <td><input class="itemRow_detail" type="checkbox">
                          <input type="hidden" name="itemid[]" id="itemid_1" value="0" /></td>
                    <td>
                    <div class="form-groupy">
                    <label for="text">Heading</label>
                    <div class="form-input-group">
                    <input type="text" class="input-control" name="detailheading[]" id="detailheading_1" /></div>
                    </div>
                    </td>
                     <td>
                      <div class="form-groupy">
                  <label for="text">Description</label>
                  <div class="form-input-group">
    <textarea class="input-control" rows="2" name="detaildescription[]" id="detaildescription_1" ></textarea></div></div>
                     </td>  
                   
                  </tr> 

<?php  }else{
$count = 0;
if(count($detailItems) > 0){
foreach($detailItems as $detailItem){
$count++;
 ?>

 <tr>
<td><input class="itemRow_detail" type="checkbox">
<input type="hidden" name="itemid[]" id="itemid_<?php echo $count; ?>" value="<?php echo $detailItem->id; ?>" /></td>

<td>
<div class="form-groupy">
<label for="text">Heading</label>
<div class="form-input-group">
<input type="text" class="input-control" name="detailheading[]" id="detailheading_<?php echo $count; ?>"  value="<?php echo $detailItem->heading; ?>" autocomplete="off" />
</div>
</div>
</td>
<td>
<div class="form-groupy">
<label for="text">About description</label>
<div class="form-input-group">
<textarea class="input-control" rows="2" name="detaildescription[]" id="detaildescription_<?php echo $count; ?>" autocomplete="off"><?php echo $detailItem->description; ?></textarea>
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
               <button class="btn btn-danger delete" id="removeRows_details" type="button"><i  class="ion-android-delete"></i> Delete</button>
               <button class="btn btn-success" id="addRows_detail" type="button"><i  class=" ion-plus"></i> Add More</button>
            </div>
         </div>






         <div class="row"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              
              <div class="center">
            
               <div class="form-group">
                  <input type="hidden" value="<?php echo $DataToEdit['id']; ?>" class="form-control" name="id" />
                  <button  type="submit" class="btn btn-success submit_btn save-btn"><i  class="ion-android-add-circle"></i> Save </button>                
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


<!--code above is for templating-->
@endsection
