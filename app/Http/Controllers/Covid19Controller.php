<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class Covid19Controller extends Controller
{
    public function index()
    {
        $sql = "select * from covid19s";

        $covid19s = DB::select($sql, []);

        return view('covid19/index', compact('covid19s'));
    }
}
