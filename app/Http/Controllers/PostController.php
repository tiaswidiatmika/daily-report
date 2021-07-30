<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Report;
use App\Models\Template;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Http\Controllers\AttachmentUploadController;
use App\Http\Requests\StoreFromTemplate;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

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
        // view all posts by all user in descending order
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
    public function store(Request $request)
    {
        Post::create($request);
    }

    public function storeFromTemplate(StoreFromTemplate $request)
    {
        // get today's report
        $request->validated();
        $report = $this->todaysReport();
        
        $newPost = $this->interpolateStringFromTemplate($request->templateId, $request);

        $post = Post::create(
            [
                'report_id' => $report->id,
                'section' => $request->ref,
                'user_id' => 1,
                'date' => $request->date,
                'time' => $request->time
            ] + $newPost
        );

        AttachmentUploadController::store($request, $post->id);
        $qr = $this->buildQrCode( $post->id );
        return view ( 'single-report', [
            'post' => $post,
            'qr' => $qr,
            'attachment' => $post->attachments()
                ->where('post_id', '=', $post->id)
                ->get(),
        ] );
        // * this view using the old template to show report
        // * before using dompdf

        // return view('report', [
        //     'post' => $post,
        //     'attachment' => $post->attachments()->where('post_id', '=', $post->id)->first(),
        // ]);
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

    public static function showPdf()
    {
    
        $post = Post::find(16);
        $qr = PostController::buildQrCode( $post->id );
        $attachment = $post->attachments()
            ->where('post_id', '=', $post->id)
            ->get();
        
        $pdf = PDF::loadView('single-report', compact('post', 'qr', 'attachment'));

        return $pdf->stream('report.pdf');
    }

    public static function buildQrCode ($postId)
    {
        $qr = Builder::create()
            ->writer(new PngWriter())
            ->writerOptions([])
            ->data(route('show-post', ['id' => $postId]))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(0)
            ->roundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->build()
            ->getDataUri();
        return $qr;
    }


    public function todaysReport () {
        // check if table reports has already had a record containing today's date
        // if not, create it
        $report = Report::firstOrCreate([
            'date' => todayIs()->date,
        ]);
        return $report;
    }

    public function buildTodaysReport () {

    }


}
