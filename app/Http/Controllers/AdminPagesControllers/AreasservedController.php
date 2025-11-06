<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\areasserved;
use DB;//import if you want to use sql commands directly


class AreasservedController extends Controller
{
   

/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      
 parent::__construct();
   
   //register admin guard in the config\auth.php   
$this->middleware('auth:blessingheartadmin');//un comment if you want to limit

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  ////////////////////////////////////////////////////////////////
public function index()
{
  //USING sql command directly, you must first import "use DB;" 
  $data =DB::select('select * from areasserved order by id desc');
        
  //for editting in the same form purposes
  $Data = array('headingtext' =>'','descriptiontext' =>'','areamapcode' =>'','id' =>0);
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.areas_served')
  ->with('DataInfo',$data)
  ->with('DataToEdit', $Data);
} 

public function store(Request $request)
{

       //inserting data
    $data = new areasserved();
    $data->headingtext = $request->headingtext; //captured from form
    $data->descriptiontext = $request->descriptiontext; //captured from form
      $data->areamapcode = $request->areamapcode; //captured from form
    $data->save();
     return redirect('manage-areasserved')->with('success','Data saved sucessfully '); //create a session variable Success to store
     //amessage
}

 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = areasserved::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database

        $data->delete();
        return redirect('manage-areasserved')->with('success','Data deleted sucessfully '); //create a session variable Success to store
        //amessage
        //
    }




 /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //returns a view which contains our form to display data to edit
        $Data = areasserved::find($id);
        $data =DB::select('select * from areasserved order by id desc');
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
          return view('pagesadmin.areas_served')
          ->with('DataToEdit',$Data)
          ->with('DataInfo',$data);
    
    }



   /**
     * Updating.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

           //updating a testimonials data
           $data = areasserved::find($id); //so we will have to find a particular data
    $data->headingtext = $request->headingtext; //captured from form
    $data->descriptiontext = $request->descriptiontext; //captured from form
      $data->areamapcode = $request->areamapcode; //captured from form
           $data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-areasserved')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }








}
