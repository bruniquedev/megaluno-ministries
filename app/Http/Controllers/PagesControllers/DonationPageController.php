<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\content_info;
use App\Models\content_details;
use Response;
use App\AppHelper;


class DonationPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Index()
    {



 $DataDonationsInfo = content_info::where('page_area_type', 'donation')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();
$Donation_detailsData =  DB::table('content_info')->leftjoin('content_details', 'content_details.related_id', '=', 'content_info.id')->where('content_info.page_area_type', 'donation')->where('content_info.ispublished', 1)->orderBy('content_details.ordersort', 'asc')->get();
//dd($Donation_detailsData);

        $title="Donate";
           return view('pages.donate')      
    ->with('DataDonationsInfo',$DataDonationsInfo)
     ->with('Donation_detailsData',$Donation_detailsData)
          ->with('title',$title);
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
