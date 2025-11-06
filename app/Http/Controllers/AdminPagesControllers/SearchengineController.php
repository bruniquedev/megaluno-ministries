<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\seo;
use DB;//import if you want to use sql commands directly

class SearchengineController extends Controller
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
  $data =DB::select('select * from seo order by id desc');
        
  //for editting in the same form purposes
  $Data = array('descriptiontext' =>'','keywordstext' =>'','author' =>'','title' =>'','id' =>0);

  $Services_info =DB::select('select * from servicesinfo');
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.searchengineoptimisation')->with('DataInfo',$data)->with('Services_info',$Services_info)->with('DataToEdit', $Data);
} 

public function store(Request $request)
{

       //inserting data
    $data = new seo();
    $data->title = $request->title; //captured from form
    $data->descriptiontext = $request->descriptiontext; //captured from form
      $data->keywordstext = $request->keywordstext; //captured from form
        $data->author = $request->author; //captured from form
    $data->save();
     return redirect('manage-seo')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
        $data = seo::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database

        $data->delete();
        return redirect('manage-seo')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = seo::find($id);
        $data =DB::select('select * from seo order by id desc');
          $Services_info =DB::select('select * from servicesinfo');
        //var_dump($data);
        //pass data to page for editting
         //passing multiple data
          return view('pagesadmin.searchengineoptimisation')->with('DataToEdit',$Data)->with('Services_info',$Services_info)->with('DataInfo',$data);
    
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
           $data = seo::find($id); //so we will have to find a particular data
             $data->title = $request->title; //captured from form
             $data->descriptiontext = $request->descriptiontext; //captured from form
           $data->keywordstext = $request->keywordstext; //captured from form
        $data->author = $request->author; //captured from form
           $data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-seo')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}