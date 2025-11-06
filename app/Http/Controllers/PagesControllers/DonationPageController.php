<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\donations;
use App\Models\donationsinfo;
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

$DataDonationsInfo= donationsinfo::where('status', 1)->orderBy('id', 'asc')->limit(1)->get();
    $id=0;
if(count($DataDonationsInfo) > 0){
$id = $DataDonationsInfo[0]->id;
}
$Donation_detailsData =DB::select('select * from donations_details where related_id=:id order by id asc',['id'=>$id]);

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
