<?php

namespace App\Http\Controllers;
use App\Exports\ExportSurveyResult;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ExportSurveyResult, 'results_enquetes.xlsx');
    }
}

