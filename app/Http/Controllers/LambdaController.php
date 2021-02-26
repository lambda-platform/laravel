<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Lambda\Puzzle\Puzzle;

class LambdaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    function index()
    {
        $permissions = null;
        $menu = null;

        $role = auth()->user()->role;

        if ($role != 1) {
            $user_group = DB::table('roles')->where('id', $role)->first();
            if ($user_group) {
                if ($user_group->permissions) {
                    $permissions = json_decode($user_group->permissions);
                    $menu = DB::table('vb_schemas')->where('id', $permissions->menu_id)->first();
                    if ($menu) {
                        $menu = $menu->schema;
                    }
                }
            }
        }

        $dbSchema = Puzzle::getDBSchema();
        $gridList = DB::table('vb_schemas')->where('type', 'grid')->get();
        $cruds = DB::table('krud')->orderBy('title')->get();

        return view('lambda', compact('dbSchema', 'gridList', 'cruds', 'permissions', 'menu'));
    }
}
