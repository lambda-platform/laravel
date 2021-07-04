<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $info = new \stdClass();
        $info->agent = DB::table('agent')->count();
        $info->customer = DB::table('customer')->count();
        $info->giveprice = DB::table('agentgiveprice')->count();
        $info->product = DB::table('baraa')->count();

        return response()->json($info);
    }
}


