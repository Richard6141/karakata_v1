<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\ExportSurveyResult;
// use App\Exports\ExportSurveyResult;
use App\Exports\ExportSurveyResult;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ExportSurveyResult, 'results_enquetes.xlsx');
    }
}
