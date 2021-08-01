<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public static function viewComposed ( $report )
    {
        $posts = $report->posts;
        $pdf = PDF::loadView('report.compose', compact('posts'));
        return $pdf->stream('report.pdf');
    }
}
