<?php

namespace App\Http\Controllers;
use PDF;

use App\Models\Post;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PdfController;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {   
        $report = Report::today(); 
        $posts = $report->posts ?? collect();
        return view( 'todays-post', compact( 'report', 'posts' ) );

    }

    public static function today () {
        // check if table reports has already had a record containing today's date
        // if not, create it
        $report = Report::firstOrCreate([
            'date' => todayIs()->date,
        ]);
        return $report;
    }

    public function compose ()
    {
        $report = Report::today();
        return PdfController::viewComposed ( $report );
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
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
