<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ReportController;

class DashboardController extends Controller
{
    public function index() {
        $todaysReportIsExist = ReportController::assertReportStatus();
        $todaysPostIsExist = $this->anyPostIsExist();
        // pass its value to build report button in dashboard view
        return view('dashboard', compact('todaysPostIsExist'));
    }

    private function anyPostIsExist()
    {
        // check has report been created or completed false
        $reportIsExist = ReportController::assertReportStatus();
        // check if there any post created that day
        return $this->todaysReportIsExist( $reportIsExist );

    }

    public function todaysReportIsExist( $reportIsExist )
    {
        return $reportIsExist ?
        ReportController::getReport()
            ->posts()
            ->get()
            ->isNotEmpty() : false;
    }

}
