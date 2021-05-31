<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    function osList()
    {

        $qr = DB::table('view_barilga_ab_list as b');

        $aimag = request('aimag');
        if ($aimag != "" || $aimag != null) {
            $qr = $qr->where('aimag_id', $aimag);
        }

        $sum = request('sum');
        if ($sum != "" || $sum != null) {
            $qr = $qr->where('sum_duureg_id', $sum);
        }

//        $year = request('year');
////        if ($year != "" || $year != null) {
////            $qr = $qr->whereRaw('YEAR(updated_at) = ' . $year);
////        }

        $qr = $qr->where('zahialga_tuluv', 'Захиалга авч буй');
      //  $qr = $qr->whereRaw('(4 in(zoriulalt_ids) or 221 in(zoriulalt_ids))');
        //$now = date('Y-m-d');
        //$qr = $qr->where('aorson_ognoo', '<=', $now);
        $qr=$qr->orderBy('updated_at', 'desc');
        return response()->json(
            $listData = $qr->paginate(20)
        );
    }

    function osDetail($id)
    {
        $data = new \stdClass();
        $data->barilga = DB::table('view_barilga_ab_detail as b')->where('id', $id)->first();
//        dump($data);
        if ($data->barilga->guiltsetgegch_comps) {
            $data->related = DB::table('view_barilga_ab as b')->
            where('id', '!=', $id)->
            where('guiltsetgegch_comps', explode(',', $data->barilga->guiltsetgegch_comps)[0])
                ->orderBy('updated_at', 'desc')->take(5)->get();
            //return view('detail', compact('data', 'related'));
        }
        $data->imgs = DB::table('t_barilga_image')->where('parent_id', $id)->get();
        $data->detail=DB::table('view_barilga_ab_detail_more')->where('barilga_id', $id)->first();
        return response()->json(
            $data
        );
    }

    function getPlanList()
    {
        $plans = DB::table('zurag_tusuls')->orderBy('created_at', 'desc')->paginate(20);
        return response()->json(
            $plans
        );
    }

    function getPlanDetail($id)
    {
        $data = new \stdClass();
        $data->plan = DB::table('zurag_tusuls')->where('id', $id)->first();
        if ($data->plan) {
            DB::table('zurag_tusuls')->where('id', $id)->update(['viewed' =>$data->plan->viewed + 1]);
        }
        $data->related = DB::table('zurag_tusuls')->where('id','!=',$id)->orderBy('created_at', 'desc')->take(5)->get();
        return response()->json(
            $data
        );
    }

    function fileDownload($id)
    {
        $data = new \stdClass();
        $data->plan = DB::table('zurag_tusuls')->where('id', $id)->first();
        if ($data->plan) {
            DB::table('zurag_tusuls')->where('id', $id)->update(['downloaded' => $data->plan->downloaded + 1]);
        }
        $data->related = DB::table('zurag_tusuls')->orderBy('created_at', 'desc')->take(5)->get();
        return response()->json(
            $data
        );
    }

    function contact()
    {
        return view('contact');
    }


}
