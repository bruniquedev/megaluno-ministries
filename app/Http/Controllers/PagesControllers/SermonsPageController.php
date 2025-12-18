<?php

namespace App\Http\Controllers\PagesControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\content_info;
use App\Models\content_details;
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
     
     $SermonsData = content_info::where('page_area_type', 'sermon')->where('ispublished', 1)->orderBy('sorted_order', 'asc')->get();

$title="Sermons";
         return view('pages.sermonsdetails')
         ->with('DataInfo',$SermonsData)
         ->with('title',strtoupper($title))
         ->with('option',$option);
    }

     public function SermonDetails($id,$title){

          $option="details";
       //var_dump($title);
     
$Sermondetails= content_info::where('page_area_type', 'sermon')->where('ispublished', 1)->where('id',$id)->first();
$detailItems = content_details::where('related_id', $id)->orderBy('ordersort', 'asc')->get();
$relatedInfo= content_info::where('page_area_type', 'sermon')->where('ispublished', 1)->where('id', '!=', $id)->orderBy('sorted_order', 'asc')->get();
//dd($detailItems);

      return view('pages.sermonsdetails')
      ->with('Details',$Sermondetails)
      ->with('detailItems',$detailItems)
      ->with('DataInfo',$relatedInfo)
      ->with('title',ucfirst($Sermondetails->title))
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
