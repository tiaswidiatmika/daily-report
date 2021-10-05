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
        $this->middleware(function ($request, $next) {
            $this->user = loggedUser();
            $this->report = ReportController::getReport();
            return $next($request);
        });
    }

    public function index ()
    {
        // sections can be added, like: laporan anu, laporan gitu, laporan blabla. can be dynamically added
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

    private function getReportSkeleton( Array $dailyReportSections )
    {
        $skeleton = array();
        foreach ($dailyReportSections as $section) {
            $skeleton[$section] = $this->getRelatedModel($section);
        }
        return $skeleton;
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

    public function finish( Request $request ): \Illuminate\Http\RedirectResponse
    {
        Report::with('posts')
            ->find($request->report)
            ->complete()
            ->posts
            ->whereIn('id', json_decode($request->posts))
            ->map( function ( $post ) { $post->complete(); } );

        session()->flash( 'formation-built', 'current report has successfully been assembled' );  
        return redirect()->route('dashboard');
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

    static public function getReport ( $specifiedDate = null )
    {
        return loggedUser()
            ->subDivision
            ->division
            ->report
            ->where('is_complete', false)
            ->sortByDesc('created_at')
            ->first();
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
            loggedUser()
                ->subDivision
                ->division
                ->report()
                ->create( [
                    'date' => todayIs()->date,
                ] ) ;
    }
}
