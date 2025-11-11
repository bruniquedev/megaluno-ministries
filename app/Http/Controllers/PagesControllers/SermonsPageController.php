<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\eventsinfo;
use App\Models\events_details;
use App\Models\donationsinfo;
use Response;
use App\AppHelper;

class SermonsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {
              $option="All";
     

     $eventsinfodata= eventsinfo::where('status', 1)->orderBy('id', 'asc')->get();

$title="Events";
         return view('pages.sermonsdetails')
         ->with('DataInfo',$eventsinfodata)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

     public function SermonDetails($id,$title){

          $option="details";
       //var_dump($title);
     
    $eventdetails= eventsinfo::where('status', 1)->where('id',$id)->get();

    $detailItems =DB::select('select * from events_details where related_id=:related_id order by id asc',["related_id"=>$id]);

    $relatedInfo= eventsinfo::where('status', 1)->where('id', '!=', $id)->orderBy('id', 'asc')->get();

    $DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();

      return view('pages.sermonsdetails')
      ->with('Details',$eventdetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('DataDonationsInfo',$DataDonationsInfo)
      ->with('title',ucfirst($title))
      ->with('option',$option);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
