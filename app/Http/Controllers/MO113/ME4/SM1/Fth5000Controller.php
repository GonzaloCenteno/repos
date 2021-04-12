<?php

namespace App\Http\Controllers\MO113\ME4\SM1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\MO113\ME5\SM1\Fth5001AExport;
// use App\Exports\MO113\ME5\SM1\Fth5001BExport;
use App\Http\Traits\GlobalFunction;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Redirect;

class Fth5000Controller extends Controller
{
    use GlobalFunction;

    public function index()
    {
        return Inertia::render("MO113/ME4/SM1/index");
    }

    public function store(Request $request)
    {
        
    }
}
