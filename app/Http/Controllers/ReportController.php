<?php

namespace App\Http\Controllers;
use PDF;

use App\Models\Post;
use ReflectionClass;
use App\Models\Report;
use Illuminate\Http\Request;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PresenceController;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->report = ReportController::getReport();
    }

    public function index ()
    {
        $sections = $this->sections();
        $report = $this->report;
        $reportSections = $this->getReportSkeleton( $sections );
        return view('report-build-container', compact('report', 'reportSections'));
    }

    public function build()
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

    private function getReportSkeleton( Array $relations )
    {
        $skeleton = array();
        foreach ($relations as $relation) {
            $skeleton[$relation] = $this->getRelatedModel($relation);
        }
        return $skeleton;
    }

    static public function getReport ( $specifiedDate = null )
    {
        return Report::where('build_completed', false)
            ->orderByDesc('created_at')
            ->first();
    }
    private function sections ()
    {
        // now there are only two sections
        return ['formations', 'posts'];
    }
    private function getRelatedModel ( $stringModel )
    {
        return $this->report->$stringModel()->get();
    }

    public function compose ()
    {
        $report = Report::today();
        return PdfController::viewComposed ( $report );
    }

    public function combine ( Request $request)
    {
        $posts = collect($request->get('posts'));
        $posts = $posts->map( function( $id ) {
            return Post::find($id);
        } );
        $isStreamingPdf = false;
        return view('report.composed-report', compact('posts', 'isStreamingPdf') + PresenceController::prepare());
    }

    public function finish( Request $request )
    {
        dd($request->all());
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

    public static function assertReportStatus()
    {
        // to check is there are report with build complete status == false
        return ReportController::getReport() !== null;
    }

    public static function firstOrCreate()
    {
        return ReportController::assertReportStatus() ?
            ReportController::getReport() :
            Report::create( ['date' => todayIs()->date] ) ;
    }
}
