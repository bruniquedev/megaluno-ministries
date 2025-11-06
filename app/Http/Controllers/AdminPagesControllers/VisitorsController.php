<?php

namespace App\Http\Controllers\AdminPagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pageview;
use App\Models\totalview;
use DB;//import if you want to use sql commands directly
class VisitorsController extends Controller
{
      public function __construct()
    {
     parent::__construct();
$this->middleware('auth:blessingheartadmin');//un comment if you want to limit
    }



   ////////////////////////////////////////////////////////////////
public function index()
{
    date_default_timezone_set('Africa/Kampala');
  //USING sql command directly, you must first import "use DB;" 
  $getUserIpsdata =DB::select('select * from pageview order by id desc');
  $Countvisitorsdata =DB::select('select distinct userip from pageview');
  
//$visittime= date('Y-m-d H:i:s');
//Removing time from date
$visittime= date('Y-m-d');
  $TodayTotalCountvisitors =DB::select('select distinct userip from pageview where visitdate =:visitdate', ['visitdate' => $visittime]);
  
 $getTotalofVisitsdata =DB::select('select * from totalview');
 $CountTotalofVisits=0;
 foreach($getTotalofVisitsdata as $visitsdata){
$CountTotalofVisits+=$visitsdata->totalvisit;
 }


  //var_dump($data);
  //passing multiple data
  return view('pagesadmin.visitors')
  ->with('getUserIpsdata',$getUserIpsdata)
  ->with('Countvisitorsdata',count($Countvisitorsdata))
  ->with('TodayTotalCountvisitors',count($TodayTotalCountvisitors))
  ->with('getTotalofVisitsdata',$getTotalofVisitsdata)
  ->with('CountTotalofVisits',$CountTotalofVisits);
 }




 /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //DB::delete('DELETE FROM users WHERE id = ?', [$id]);
        DB::delete('delete from pageview');
        DB::delete('delete from totalview');
        return redirect('manage-visitors')->with('success','Data deleted sucessfully '); //create a session variable Success to store
        //amessage
        //
    }




}
