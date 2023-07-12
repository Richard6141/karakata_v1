<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class HandleErrorController extends Controller
{
    public function error_404 ():View
    {
        return view('errors.page-404');
    }


    public function error_405(): View{
        return view('errors.page-405');
    }

    public function error_500():View{
        return view('errors.page-422');
    }
}
