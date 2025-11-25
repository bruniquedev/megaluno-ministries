<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\testimonials;//must be imported
use DB;//import if you want to use sql commands directly
use DateTime;
class TestimonialsController extends Controller
{


 /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       //call the parent controller which is the base controller using statement below
 // to make sure that the global variables in base controller are recieved in views whose 
 //controllers have a constructors. For those views whose controllers doesnt have a constructor 
 //in them you dont need to call this        
 parent::__construct();
        ////this helps in limiting those who are not logged in
//you can copy and paste this into other controllers where you want to limit login
      
   //register admin guard in the config\auth.php   
$this->middleware('auth:megalunaadmin');//un comment if you want to limit

        //go to app\Http\Controllers\Middleware\Authenticate.php in redirectTo function and the page/route
        //for redirection if user is not logged in return route('adminlogin')
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
  $data =DB::select('select * from testimonials order by id desc');

  //for editting in the same form purposes
  $Data = array('ratings'=>'','name' =>'', 'email' =>'', 
  'descriptiontext' => '', 'id' =>0);
  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.testimonials')->with('Datatestimonials',$data)->with('DataToEdit', $Data);
} 
public function store(Request $request)
{
    $date=new DateTime('NOW');
//$currentDate=date_format($date,"Y-m-d"); 
$currentDate=date_format($date,"Y-m-d H:i:s");//24hr
    //let's try to store our data using tinker like commands here
    //
       //inserting data
    $data = new testimonials;
    $data->name = $request->testifiersName; //captured from form
    $data->email = $request->email;//captured from form
    $data->descriptiontext = $request->descriptiontext;//captured from form
    $data->ratings = $request->type;//captured from form
    $data->status =0;
    $data->reviewdate = $currentDate;
    $data->save();
     return redirect('manage-testimonials')->with('success','Data saved sucessfully '); //create a session variable Success to store
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
        $data = testimonials::find($id); //so we will have to find a particular post  
        //here we are going to delete from the database
        $data->delete();
        return redirect('manage-testimonials')->with('success','Data deleted sucessfully '); //create a session variable Success to store
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
        $Data = testimonials::find($id);
        $data =DB::select('select * from testimonials order by id desc');
        //var_dump($data);
        //pass data to page for editting
//passing multiple data
          return view('pagesadmin.testimonials')->with('DataToEdit',$Data)->with('Datatestimonials',$data);
    
    }


      public function update_testimoniastatus($id)
    {
        //returns a view which contains our form to display data to edit
        $Data = testimonials::find($id);
            //var_dump($Data); die();
          if($Data->status==0){
            $Data->status=1;
          }else if($Data->status==1){
            $Data->status=0;
          }
          $Data->save();

    return redirect('manage-testimonials')->with('success','Data updated sucessfully '); //create a session variable Success to store
    
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
           $data = testimonials::find($id); //so we will have to find a particular data
           $data->name = $request->testifiersName; //captured from form
           $data->email = $request->email;//captured from form
           $data->descriptiontext = $request->descriptiontext;//captured from form
           $data->ratings = $request->type;//captured from form
           $data->save();

    //DB::update('update student set first_name = ?,last_name=?,city_name=?,email=? where id = ?',[$first_name,$last_name,$city_name,$email,$id]);
            return redirect('manage-testimonials')->with('success','Data updated sucessfully '); //create a session variable Success to store
            //amessage
    }






///////////////////////////////////////////////////////////////////////////////////////



    //
}
