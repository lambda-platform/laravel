<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use http\Client;

class PageController extends Controller
{
    function index()
    {
        $last_year=2018;
        $currentM=12;
        $lastM=11;
//        $contact = DB::table("contact")->where('id', 1)->first();
        $user = Auth::user();
        $menu = DB::table("t_togtmol")->where('undsen_id', 102)->where('active', 1)->orderBy('daraalal')->get();

        $data = new \stdClass();

        # Filters
        $data->aimag = DB::table('t_aimag')->get();
        $data->sum = DB::table('t_sum_duureg')->where('aimag_id',22)->get();
//        $data->bag = DB::table('t_bag_horoo')->get();
        $data->zereglel = DB::table('t_togtmol')->where('undsen_id', 41)->where('code', 4)->get();
        $year = DB::table('t_year')->get();
        $data->year=DB::table("t_togtmol")->where('undsen_id', 103)->where('active', 1)->orderBy('daraalal')->get();

        //ALL
        //$qrAll = (int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where   zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids))')[0]->ailtoo;// or 221 in (zoriulalt_ids)


        $qrAll = DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv', 453)
            //->whereIn('b.zoriulalt_ids', [4])->orWhereIn('b.zoriulalt_ids', [221])
            // ->whereRaw('(4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)')
            ->selectRaw('sum(ail_too) as ailtoo');
        // dump($qrAll);

        $data->all = $qrAll->first()->ailtoo;
        $data->allUb = $qrAll
            ->where('b.aimag_id', 22)
            ->first()->ailtoo;
        $data->allCountry = $data->all - $data->allUb;

        //Niitiin
        $qrNiitiin = DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv', 453)
            ->whereIn('b.zoriulalt_ids', [4])//->orWhereIn('b.zoriulalt_ids', [221])
            // ->whereRaw('(4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)')
            ->selectRaw('sum(ail_too) as ailtoo');

        $data->niitiin = $qrNiitiin->first()->ailtoo;
        $data->niitiinUb = $qrNiitiin->where('b.aimag_id', 22)->first()->ailtoo;
        $data->niitiinCountry = $data->niitiin - $data->niitiinUb;

        //Aminii
        $qrami = DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv', 453)
            ->whereIn('b.zoriulalt_ids', [221])//->orWhereIn('b.zoriulalt_ids', [221])
            // ->whereRaw('(4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)')
            ->selectRaw('sum(ail_too) as ailtoo');

        $data->aminii = $qrami->first()->ailtoo;
        if($data->aminii==null) {
            $data->aminii = 0;
        }
        $data->aminiiUb = $qrami->where('b.aimag_id', 22)->first()->ailtoo;
        if($data->aminiiUb==null) {
            $data->aminiiUb = 0;
        }
        $data->aminiiCountry = $data->aminii - $data->aminiiUb;


        $currentMonth = Carbon::create($last_year, $currentM, 1, 0, 0, 0);
        $previousMonth = Carbon::create($last_year, $lastM, 1, 0, 0, 0);

        $data->lastMonthAvg = DB::table('t_barilga as b')
            ->join('t_une as u', 'u.barilga_id', '=', 'b.id')
            ->whereNotNull('u.barilga_id')
            ->whereNotNull('u.UnitPrice')
            ->where('b.zahialga_tuluv', 453)
            ->whereIn('b.zoriulalt_ids', [4])
//            ->orWhereIn('b.zoriulalt_ids', [221])
            ->whereNull('b.deleted_at')
            ->whereBetween('u.AddDate', [$currentMonth->format('Y-m-d'), $currentMonth->addMonth()->format('Y-m-d')])
            ->avg('u.UnitPrice');
        if($data->lastMonthAvg==null) {
            $data->lastMonthAvg = 0;
        }

        $data->previousMonthAvg = DB::table('t_barilga as b')
            ->join('t_une as u', 'u.barilga_id', '=', 'b.id')
            ->whereNotNull('u.barilga_id')
            ->whereNotNull('u.UnitPrice')
            ->whereIn('b.zoriulalt_ids', [4])
//            ->orWhereIn('b.zoriulalt_ids', [221])
            ->where('b.zahialga_tuluv', 453)
            ->whereNull('b.deleted_at')
            ->whereBetween('u.AddDate', [$previousMonth->format('Y-m-d'), $previousMonth->addMonth()->format('Y-m-d')])
            ->avg('u.UnitPrice');
        if($data->previousMonthAvg==null) {
            $data->previousMonthAvg = 0;
        }

        if ($data->previousMonthAvg != 0) {
            $data->monthPercent = (($data->lastMonthAvg * 100) / $data->previousMonthAvg) - 100;
        } else {
            $data->monthPercent = 0;
        }
        $data->duureg = $this->getDuureg();
        if($data->duureg==null) {
            $data->duureg = 0;
        }
        $data->monthly = $this->monthlyPriceLastYear($last_year);

        $durem=DB::table('about')->where('id',22)->first();
        $medee=DB::table('about')->where('id',21)->first();
        $properties = DB::table('properties')->get();
//        dd($data);
        return view('index', compact('user','menu', 'data', 'durem', 'medee', 'properties'));
    }


    function getDuureg()
    {
        //  return DB::table('t_barilga as b')
//            ->join('t_une as u', 'u.barilga_id', '=', 'b.id')
//            ->selectRaw('avg(u.UnitPrice) as avg_une, b.sum_duureg_id as duureg')
//            ->whereNotNull('u.barilga_id')
//            ->whereNotNull('u.UnitPrice')
//            ->whereIn('b.os_turul_id', [4])
//            ->where('b.aimag_id', 22)
//            ->where('.AddDate', '>', '2018-01-01')
//            ->whereNull('b.deleted_at')
//            ->groupBy('b.sum_duureg_id')
//            ->pluck('avg_une', 'duureg');

        DB::table('t_barilga as b')
            ->join('t_une as u', 'u.barilga_id', '=', 'b.id')
            ->selectRaw('avg(u.UnitPrice) as avg_une, b.sum_duureg_id as duureg')
            ->whereNotNull('u.UnitPrice')
            ->where('b.zahialga_tuluv', '>',452)
            ->where('b.zahialga_tuluv', '<', 457)
            ->whereIn('b.zoriulalt_ids', [4])//->orWhereIn('b.zoriulalt_ids', [221])
            // ->whereRaw('(4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)')
            ->where('b.aimag_id', 22)
            // ->where('.AddDate', '>', '2018-01-01')
            ->whereNull('b.deleted_at')
            ->groupBy('b.sum_duureg_id')
            ->pluck('avg_une', 'duureg');
    }
    function monthlyPriceLastYear($lastyear)
    {
        $lastyearplus=$lastyear+1;
        $data = DB::table('t_barilga as b')
            ->leftJoin('t_une as u', 'u.barilga_id', '=', 'b.id')
            ->where('b.zahialga_tuluv',453)
            ->whereIn('b.zoriulalt_ids', [4])
            ->whereNull('b.deleted_at')
            ->selectRaw('avg(u.UnitPrice) as avg_une, MONTH(u.AddDate) as month')
            ->whereNotNull('u.barilga_id')
            ->whereNotNull('u.UnitPrice')
            ->where('u.AddDate','>',$lastyear.'-01-01')
            ->where('u.AddDate', '<',$lastyearplus.'-01-01')
            ->groupBy(DB::raw('month'))
            ->get();

        return $data;



        if ($currentMonth < 12) {
            $datac = DB::table('t_barilga as b')
                ->leftJoin('t_une as u', 'u.barilga_id', '=', 'b.id')
                ->whereNotNull('u.UnitPrice')
                ->where('b.zahialga_tuluv',453)
                ->selectRaw('avg(u.UnitPrice) as avg_une, MONTH(u.AddDate) as month')
                ->where('u.AddDate', '>', date('Y'))
                ->groupBy(DB::raw('month'))
                ->get();

            $datap = DB::table('t_barilga as b')
                ->leftJoin('t_une as u', 'u.barilga_id', '=', 'b.id')
                ->where('b.zahialga_tuluv',453)
                ->whereNull('b.deleted_at')
                ->selectRaw('avg(u.UnitPrice) as avg_une, MONTH(u.AddDate) as month')
                ->whereNotNull('u.barilga_id')
                ->whereNotNull('u.UnitPrice')
                ->where('u.AddDate', '>', date('Y', strtotime("-1 year")) . '-' . $currentMonth . '-01')
                ->where('u.AddDate', '<', date('Y'))
                ->groupBy(DB::raw('month'))
                ->get();

            $data = $datap->merge($datac);
        } else {
            $data = DB::table('t_barilga as b')
                ->leftJoin('t_une as u', 'u.barilga_id', '=', 'b.id')
                ->where('b.zahialga_tuluv', '>',452)
                ->where('b.zahialga_tuluv', '<', 457)
                ->whereNull('b.deleted_at')
                ->selectRaw('avg(u.UnitPrice) as avg_une, MONTH(u.AddDate) as month')
                ->whereNotNull('u.barilga_id')
                ->whereNotNull('u.UnitPrice')
                ->where('u.AddDate', '>', date('Y'))
                ->groupBy(DB::raw('month'))
                ->get();
        }
        return $data;
    }
    function filter()
    {
        $data = new \stdClass();


        $qrNiitiin= DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv','>',452)
            ->where('b.zahialga_tuluv','<',457)
            ->whereRaw('4 in(zoriulalt_ids)')
            ->whereNull('b.deleted_at');
        $this->filterAppend($qrNiitiin);
        $data->niitiin=$qrNiitiin->selectRaw('count(id) as ailtoo')->first()->ailtoo;
        $data->niitiinObject=$qrNiitiin->selectRaw('sum(ail_too) as ailtoo')->first()->ailtoo;
        $data->niitiinObjectInActive=$qrNiitiin->where('b.zahialga_tuluv',453)->selectRaw('sum(ail_too) as ailtoo')->first()->ailtoo;
        $data->niitiinObjectInActivePercent=$data->niitiinObject==0?0:round($data->niitiinObjectInActive*100/$data->niitiinObject);


        $qrAminii=DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv','>',452)
            ->where('b.zahialga_tuluv','<',457)
            ->whereRaw('221 in(zoriulalt_ids)')
            ->whereNull('b.deleted_at');
        $this->filterAppend($qrAminii);
        $data->aminii= $qrAminii->selectRaw('count(id) as ailtoo')->first()->ailtoo;

        $data->aminiiObject=$qrAminii->selectRaw('sum(ail_too) as ailtoo')->first()->ailtoo;
        $data->aminiiObjectInActive=$qrAminii->where('b.zahialga_tuluv',453)->selectRaw('sum(ail_too) as ailtoo')->first()->ailtoo;
        $data->aminiiObjectInActivePercent=$data->aminiiObject==0?0:round($data->aminiiObjectInActive*100/$data->aminiiObject);

        //ALL
        $data->all=$data->niitiin+$data->aminii;
        $data->allObject=$data->niitiinObject+$data->aminiiObject;
        $data->allObjectInActivePercent=$data->allObject==0?0:round(($data->aminiiObjectInActive+$data->niitiinObjectInActive)*100/$data->allObject);

//
        $data->monthly = $this->monthlyPrice();
        return response()->json($data);
    }

    function monthlyPrice()
    {
        $qr = DB::table('t_barilga as b')
            ->where('b.zahialga_tuluv',453)
            ->whereRaw('4 in(zoriulalt_ids)')
            ->whereNull('b.deleted_at');

        $qr = $this->filterAppend($qr);

        $year = request('year');
        if ($year == "" || $year == null) {
            $year = date('Y');
        }

        return $qr->join('t_une as u', 'u.barilga_id', '=', 'b.id')
            ->selectRaw('avg(u.UnitPrice) as avg_une, MONTH(u.AddDate) as month')
            ->whereNotNull('u.UnitPrice')
            ->whereYear('u.AddDate', '=', $year)
            ->groupBy(DB::raw('month'))
            ->get();
    }

    function filterAppendRaw($qr)
    {
        $aimag = request('aimag');
        if ($aimag != "" || $aimag != null) {
            $qr .= ' and b.aimag_id = ' . $aimag;
        }

        $sum = request('sum');
        if ($sum != "" || $sum != null) {
            $qr .= ' and b.sum_duureg_id = ' . $sum;
        }

        $year = request('year');
        if ($year != "" || $year != null) {
            $qr .= ' and YEAR(b1.AddDate) = ' . $year;
        }

        return $qr;
    }

    function filterAppend($qr)
    {
        $aimag = request('aimag');
        if ($aimag != "" || $aimag != null) {
            $qr = $qr->where('b.aimag_id', $aimag);
        }

        $sum = request('sum');
        if ($sum != "" || $sum != null) {
            $qr = $qr->where('b.sum_duureg_id', $sum);
        }

        $zereglel = request('zereglel');
        if ($zereglel != "" || $zereglel != null) {
            $qr = $qr->where('b.zereglel_ids', $zereglel);
        }

//        $year = request('year');
//        if ($year != "" || $year != null) {
//            $qr = $qr->whereYear('u.AddDate', '=', $year)->whereMonth('u.addDate', '=', 6);
//        }

        return $qr;
    }
    function getSum($aimag)
    {
        return DB::table('t_sum_duureg')
            ->where('aimag_id', $aimag)
            ->orderBy('ner')
            ->select('id', 'ner')
            ->get();
    }

    function getBagHoroo($sum)
    {
        return DB::table('lubaghoroo')
            ->where('sum_id', $sum)
            ->orderBy('name')
            ->select('id', 'name', 'code')
            ->get();
    }

    function getCategory($id)
    {
        $data = DB::table("t_togtmol_turul")->where('code', $id)->orderBy('ner')->get();
        return response()->json(
            $data
        );
    }

    function getSubcategory($id)
    {
        $data = DB::table("t_togtmol")->where('undsen_id', $id)->orderBy('ner')->get();
        return response()->json(
            $data
        );
    }

    function getNewsList()
    {
        $data = DB::Table('contents')->orderBy('id', 'desc')->paginate(12);
        return response()->json(
            $data
        );
    }

    function getNewsDetail($id)
    {
        $data = DB::Table('contents')->where('id', $id)->first();
        return response()->json(
            $data
        );
    }

    function getPaperList()
    {
        $data = DB::Table('papers')->orderBy('id', 'desc')->whereNull('deleted_at');

        if (request('cat1')) {
            $data->where('category1', request('cat1'));
        }

        if (request('cat2')) {
            $data->where('category2', request('cat2'));
        }


        if (request('search')) {
            //dd();
            $data->whereRaw('lower(CONCAT_WS(\' \',' . request('checkedFilters') . ')) like lower(\'%' . request('search') . '%\')');
        }

        return response()->json(
            $data->paginate(20)
        );
    }

    function getPaperDetail($id)
    {
        $data = DB::Table('papers')->where('id', $id)->first();
        return response()->json(
            $data
        );
    }

}
