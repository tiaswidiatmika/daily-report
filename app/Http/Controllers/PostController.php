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
        $templateFillable = $template->getFillable();
        $dynamicColumns = $request->only( $template->dynamicColumns );
        $container = [];

        foreach ($templateFillable as $column) {
            $target = $template->$column;
            foreach ($dynamicColumns as $pattern => $replacement) {
                $pattern = '['.replaceUnderScore($pattern).']';
                $pattern = preg_quote($pattern, '/');
                $target = preg_replace('/'.$pattern.'/', $replacement, $target);
            }
            $container[$column] = $target;
        }
        return $container;
    }

    public function index()
    {
        // view all posts by all users in descending order
        return Post::all()->sortByDesc('created_at');
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
                'title' => Template::find($request->templateId)->template_name,
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
        // dd($request->all());
        $request->validated();
        // first or create todays report
        $report = ReportController::firstOrCreate();
        // prepare new post
        $newPost = $this->interpolateStringFromTemplate($request->templateId, $request);
        // persist all
        $post = $this->store( $report, $request, $newPost );
        // update created qrcode file name as path in this post
        PostController::createQrCodePng( $post );
        // store any attachments
        Attachment::store($request, $post->id);
        // disable show pdf to make a build report test
        // return $this->showPdf( $post->id );
        // return view ( 'single-report', compact( 'post' ) );

        // instead, return to dashboard
        return redirect('/');
        
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
        // return view('single-report', [
        //     'post' => $post,
        //     'qr' => $this->buildQrCode( $id ),
        //     'attachment' => $post->attachments()
        //         ->where('post_id', '=', $post->id)
        //         ->get(),
        // ]);
        $isStreamingPdf = false;
        return view('report.single-post', compact('post', 'isStreamingPdf'));
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

    public function testing()
    {
        $report = Report::find(1);
        $posts = $report->posts()->get();
        $isStreamingPdf = true;
        $pdf = PDF::loadView('report.pdf-composed', compact('posts', 'isStreamingPdf'));
        return $pdf->stream('report.pdf');
    }
}
