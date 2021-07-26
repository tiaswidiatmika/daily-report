<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AttachmentUploadController;
use App\Models\Post;
use App\Models\Template;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Http\Request;
use PDF;

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
        $collumnsToFill = $template->getFillables();
        $inputs = $template->setupInputs();
        $container = [];

        foreach ($collumnsToFill as $tableCollumn) {
            $sentence = $template->$tableCollumn;
            foreach ($inputs as $input) {
                $pattern = '/\[' . $input . '\]/';
                $input = preg_replace('/\s/', '_', $input);
                $sentence = preg_replace($pattern, $request->$input, $sentence);
            }
            $container[$tableCollumn] = $sentence;
        }
        return $container;

    }

    public function htmlMarkup($post)
    {
        $date = now();
        $translateMonths = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $translateDays = [
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => "Jum'at",
            'Sat' => 'Sabtu',
        ];
        $post['title'] = '';
        $post['tanggal_nesia'] = "{$translateDays[$date->format('D')]}, {$date->format('d')} {$translateMonths[$date->format('m')]} {$date->format('Y')}";
        foreach ($post as $attribute => $value) {
            switch ($attribute) {
                case 'title':
                    $post['title'] = $post['tanggal_nesia'];
                    break;

                case 'case':
                    $post['case'] = "$value";
                    break;

                case 'summary':
                    $post['summary'] = "$value";
                    break;

                case 'chronology':
                    $post['chronology'] = $value;
                    break;

                case 'measure':
                    $post['measure'] = $value;
                    break;

                case 'conclusion':
                    $post['conclusion'] = $value;
                    break;

                default:
                    # code...
                    break;
            }
        }
        return $post;
    }
    public function index()
    {
        // view all posts by all user in descending order
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
    public function store(Request $request)
    {
        Post::create($request);
    }

    public function storeFromTemplate(Request $request)
    {

        $newPost = $this->interpolateStringFromTemplate($request->templateId, $request);
        // protected $fillable = ['user_id','title', 'case', 'summary', 'chronology', 'measure', 'conclusion', 'tanggal_nesia'];
        $newPost = $this->htmlMarkup($newPost);

        $post = Post::create(
            [
                'section' => $request->ref,
                'user_id' => 1,
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

    public function showPdf($id)
    {
        $post = Post::find($id);
        $qr = $this->buildQrCode( $post->id );
        
        $pdf = PDF::loadView('single-report', compact('post', 'qr'));

        return $pdf->stream('report.pdf');
    }

    public function buildQrCode ($postId)
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
}
