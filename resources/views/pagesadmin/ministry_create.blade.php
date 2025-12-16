@extends('layoutsadmin.layouts.app') <!--The reason for this is because we this particular layout to belong to views -> layouts -> app.blade.php-->

@section('content') 

<div class="container card-In m-t-150 m-b-50" >
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
    <form role="form" method="post" action="{{ route('manage-ministries.store') }}" name="FORM" class="about-form" id="about-form" enctype="multipart/form-data">
    @else
    <form action="{{ route('manage-ministries.update', $DataToEdit['id']) }}" method="post" name="FORM" 
  enctype="multipart/form-data">
  @method('PUT')
  @endif

    @csrf <!--it provided a token which verifies that the form submitted came from the same url of the application-->
  
      <div>
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <div class="panel_container-heading flex align-items-center flex-grow">
               <h4 class="h2-title m-r-10">Save / Create ministry info</h4> 
               <a class="btn-ui btn-ui-primary btn-ui-xs" id="link1" href="{{ route('manage-ministries.create') }}"><i class="ion ion-android-add-circle"></i> Create</a>
            </div>
            </div>               
         </div>


  <div class="row">

           
             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-groupy">
                  <label for="text">Title </label>
                  <div class="form-input-group">
                  <textarea class="form-control input_box_borderless" rows="2" name="title"><?php echo $DataToEdit['title']; ?></textarea>
               </div>
               </div>
            </div>


            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-groupy">
                  <label for="text">Description </label>
                  <div class="form-input-group">
                  <textarea class="form-control input_box_borderless" rows="2" name="description"><?php echo $DataToEdit['description']; ?></textarea>
               </div>
               </div>
            </div>    

             <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

               <div class="form-groupy">
               <div class="input_label">Add image</div>
               <!--upload field one-->
               <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
               <i class="ion ion-upload left"></i>  
               Select<input type="file" name="input_file"  id="imagefile" accept="image/*" class="text-bold input-fileup">
               </span>
               <!--/upload field one-->
               <div class="custom-img-previewer" style="background-image: url('{{ asset("storage/content_uploads/thumbnails/".$DataToEdit["filename"]) }}'); width:40px;height:40px;">
                  <span data-id="{{$DataToEdit['id']}}" data-table="content_info" data-column="filename" data-route="remove-image" class="close-img-btn" >×</span>
                  <div class="view-file-btn" ><a href='{{ asset("storage/content_uploads/thumbnails/".$DataToEdit["filename"]) }}' class="custom-file-opener" target="_blank">open</a></div>
                <div class="img-previewerPopover"></div>
               </div>
               </div>

            </div>  
            
          
         
                                                 
        
         </div>

       

        

   <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <h4 class="h2-title">Ministry details</h4> 
            </div>               
         </div>

            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="dynam-table table-container ministry-view-table" addRowBtnTarget="addRowBtnList" RemoveRowsBtnTarget="deleteCheckedRowsBtnList"> 
                <thead id="tablehead">
                <tr class="thead table-light">
                     <th scope="col" width="2%"><input class="dynam-checkAll" type="checkbox"></th>
                     <th scope="col" width="25%">Heading</th>
                     <th scope="col" width="40%">Description</th>
                     <th scope="col" width="25%">Image</th>
                     <th scope="col" width="8%">Remove</th>
                  </tr> 
                   </thead>
        <tbody data-inputs='[
    {"type": "textarea", "attributes": {"name": "detailheadinglist[]", "rows": "3", "label": "Heading", "class": "input-control"}},
    {"type": "textarea", "attributes": {"name": "detaildescriptionlist[]", "rows": "3", "label": "Description", "class": "input-control"}},
    {"type": "file","attributes": {"name": "input_filelist[]","id": "imagefile","accept": "image/*", "label": "Add image", "class": "text-bold input-control input-fileup" }}
]' data-idname="itemidlist" data-ordersortname="ordersortlist" >

            <!-- Table rows will be dynamically added here -->  
                     <?php  ?>
                  <?php  if(count($ListdetailItems)<=0){ ?>                 
                  <tr>
                     <td data-label="Check"><input type="checkbox">
                        <input type="hidden" name="itemidlist[]" value="0" />
                       <input type="hidden" name="ordersortlist[]" class="ordersortinput" value="0" />
                    </td>
                     <td data-label="Heading">
                    <div class="form-groupy">
                    <label for="text">Heading</label>
                    <div class="form-input-group">
                    <textarea class="input-control" rows="3" name="detailheadinglist[]"></textarea>
                    </div>
                    </div>
                    </td>
                     <td data-label="Description">
                      <div class="form-groupy">
                  <label for="text">Description</label>
                  <div class="form-input-group">
    <textarea class="input-control" rows="3" name="detaildescriptionlist[]"></textarea></div></div>
                     </td>  
                             <td data-label="Image">
               <div class="form-groupy">
               <div class="input_label">Add image</div>
               <span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
               <i class="ion ion-upload left"></i>  
               Select<input type="file" name="input_filelist[]" id="imagefile" accept="image/*" class="text-bold input-fileup">
               </span>
            <div class="custom-img-previewer" style="width:40px;height:40px;">
               <span data-id="0" data-table="content_details" data-column="no" data-route="remove-image" class="close-img-btn" >×</span>
               <div class="view-file-btn" ><a href='javascript:void(0);' class="custom-file-opener" target="_blank">open</a></div>
               <div class="img-previewerPopover"></div>
            </div>
            </div>
            </td>
          <td data-label="Remove"><button class="btn-ui btn-ui-xs btn-ui-danger" type="button" ><i  class="ion-android-delete"></i></button></td> 
                  </tr> 

<?php  }else{
$count = 0;
if(count($ListdetailItems) > 0){
foreach($ListdetailItems as $ListdetailItem){
$count++;
 ?>

 <tr>
<td data-label="Check"><input type="checkbox">
<input type="hidden" name="itemidlist[]" value="<?php echo $ListdetailItem->id; ?>" />
<input type="hidden" name="ordersortlist[]" class="ordersortinput" value="<?php echo $ListdetailItem->ordersort; ?>" />
</td>

<td data-label="Heading">
<div class="form-groupy">
<label for="text">Heading</label>
<div class="form-input-group">
<textarea class="input-control" rows="3" name="detailheadinglist[]"><?php echo $ListdetailItem->headinglist; ?></textarea>
</div>
</div>
</td>

<td data-label="Description">
<div class="form-groupy">
<label for="text">Description</label>
<div class="form-input-group">
<textarea class="input-control" rows="3" name="detaildescriptionlist[]" autocomplete="off"><?php echo $ListdetailItem->descriptionlist; ?></textarea>
</div>
</div>
</td>

<td data-label="Image">
<div class="form-groupy">
<div class="input_label">Add image</div>
<span class="btn-upload-1 btn-upload-file-1 btn-ui-black">
<i class="ion ion-upload left"></i>  
Select<input type="file" name="input_filelist[]" id="imagefile" accept="image/*" class="text-bold input-fileup">
</span>
<div class="custom-img-previewer" style="background-image: url('{{ asset("storage/content_uploads/details/thumbnails/".$ListdetailItem->filenamelist) }}'); width:40px;height:40px;">
   <span data-id="<?php echo $ListdetailItem->id; ?>" data-table="content_details" data-column="filenamelist" data-route="remove-image" class="close-img-btn" >×</span>
   <div class="view-file-btn" ><a href='{{ asset("storage/content_uploads/details/thumbnails/".$ListdetailItem->filenamelist) }}' class="custom-file-opener" target="_blank">open</a></div>
   <div class="img-previewerPopover"></div>
</div>
</div>
</td>

 <td data-label="Remove"><button class="btn-ui btn-ui-xs btn-ui-danger" type="button" ><i  class="ion-android-delete"></i></button></td> 
                                   
                  </tr> 


<?php 
}
}
} ?>


                 </tbody>
               </table>
            </div>
         </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <button class="btn-ui btn-ui-danger delete" id="deleteCheckedRowsBtnList" type="button"><i  class="ion-android-delete"></i> Delete</button>
               <button class="btn-ui btn-ui-black" id="addRowBtnList" type="button"><i  class=" ion-plus"></i> Add More</button>
            </div>
         </div>






          <div class="row m-t-10"> 
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="center">
               <div class="form-group">
                  <input type="hidden" value="<?php echo $DataToEdit['id']; ?>" class="form-control" name="id" />
                  <button  type="submit" class="btn-ui btn-ui-md btn-ui-success submit_btn save-btn"><i  class="ion-android-add-circle"></i> Save </button>               
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
