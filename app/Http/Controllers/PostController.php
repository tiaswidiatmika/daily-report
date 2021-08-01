<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Report;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFromTemplate;
use App\Http\Controllers\AttachmentUploadController as Attachment;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\QrcController as QrCode;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct()
    // {
    //     $this->middleware(['auth'])->only(['create', 'store']);
    // }

    public function interpolateStringFromTemplate($templateId, $request)
    {
        $template = Template::find($templateId);
        $columnsToFill = $template->getFillables();
        
        $inputs = $template->setupInputs();
        $container = [];
        
        foreach ($columnsToFill as $tableColumn) {
            $sentence = $template->$tableColumn;
            foreach ($inputs as $input) {
                $pattern = '/\[' . $input . '\]/';
                $input = preg_replace('/\s/', '_', $input);
                $sentence = preg_replace($pattern, $request->$input, $sentence);
            }
            $container[$tableColumn] = $sentence;
        }
        return $container;

    }

    public function index()
    {
        // view all posts by all users in descending order
        return Post::all()->sortByDesc('created_at');
    }

    public function dashboard() {
        // check if there any post created that day
        $todaysDate = todayIs()->date;
        $todaysPost = Post::where('date', $todaysDate)->first() !== null ? true : false;
        // pass its value to buil report button in dashboard view
        return view('dashboard', [
            'todaysPostIsExist' => $todaysPost,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( $report, $request, $newPost )
    {
        $post = Post::create(
            [
                'report_id' => $report->id,
                'section' => $request->ref,
                'user_id' => 1,
                'date' => $request->date,
                'time' => $request->time
            ] + $newPost
        );
        return $post;
    }

    public function storeFromTemplate(StoreFromTemplate $request)
    {
        $request->validated();
        // first or create todays report
        $report = ReportController::today();
        // prepare new post
        $newPost = $this->interpolateStringFromTemplate($request->templateId, $request);
        // persist all
        $post = $this->store( $report, $request, $newPost );
        // update created qrcode file name as path in this post
        PostController::createQrCodePng( $post );
        // store any attachments
        Attachment::store($request, $post->id);
        return $this->showPdf( $post->id );
        // return view ( 'single-report', compact( 'post' ) );
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find( $id );
        return view('single-report', [
            'post' => $post,
            'qr' => $this->buildQrCode( $id ),
            'attachment' => $post->attachments()
                ->where('post_id', '=', $post->id)
                ->get(),
        ]);
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

    public static function showPdf( $id )
    {
        $post = Post::find( $id );   
        $pdf = PDF::loadView('single-report', compact('post'));
        return $pdf->stream('report.pdf');
    }

    public static function createQrCodePng ( $post )
    {
        $qrFileName = QrCode::write( $post->id );
        $post->qrcode = $qrFileName;
        $post->save();
    }
}
