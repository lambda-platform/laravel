<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Lambda\Puzzle\Puzzle;


class RealStateController extends Controller
{
    public function index()
    {
        $permissions = null;
        $menu = null;
        $user = Auth::user();
        $role = $user->role;
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

                $dbSchema = Puzzle::getDBSchema();
                $gridList = DB::table('vb_schemas')->where('type', 'grid')->get();
                $cruds = DB::table('krud')->orderBy('title')->get();

            return view('lambda', compact('dbSchema', 'gridList', 'cruds', 'permissions', 'menu','role'));
    }


    public function getbarilgadetail($barilgaid)
    {
        $res = DB::table('t_barilga_detail')->where('barilga_id', $barilgaid)->first();
        if($res==null)
        {
            DB::table('t_barilga_detail')->insert(['barilga_id' => $barilgaid]);
            $res = DB::table('t_barilga_detail')->where('barilga_id', $barilgaid)->first();

        }
        return response()->json([
            'data' => $res ? $res->id : 0
        ]);
    }

    public function pricelist()
    {
        return DB::table('view_agentgiveprice')
            ->orderBy('actiondate', 'desc')->paginate(20);
    }

    public function ezemshillist()
    {
        return DB::table('ezemshil')->get();
    }

    public function customerlist()
    {
        return DB::table('customer')->orderBy('name')->get();
    }

    public function agentslist()
    {
        return DB::table('agent')->orderBy('name')->get();
    }

    public function teeverlegchlist()
    {
        return DB::table('teeverlegch')->orderBy('name')->get();
    }

    public function containerwagonlist()
    {
        return DB::table('containerwagon')->orderBy('name')->get();
    }

    public function uniinbuleglist()
    {
        return DB::table('uniinbuleg')->orderBy('name')->get();
    }

    public function fromtoteevriinnuhtsullist()
    {
        return DB::table('teevriinnukhtsul')->orderBy('name')->get();
    }

    public function fromtolist()
    {
        return DB::table('boomt')->orderBy('name')->get();
    }

    public function fromtolistmtz()
    {
        return DB::table('mtzboomt')->orderBy('name')->get();
    }

    public function exchangelist()
    {
        return DB::table('exchange')->orderBy('name')->get();
    }

    public function baglaaboodollist()
    {
        return DB::table('baglaaboodol')->orderBy('name')->get();
    }

    public function getagentgivenprice(Request $request)
    {
        $sdate = $request->input('sdate');
        // $agentgivenprice=DB::table('agentgiveprice')->where('pricetype','agentgiveprice')->whereRaw('date(actiondate) = ?', $sdate)->get();
        //->whereDay('actiondate',$sdate)->get();

        return DB::table('agentgiveprice')->where('agentgiveprice.pricetype', 'agentgiveprice')->whereRaw('date(agentgiveprice.actiondate) = ?', $sdate)
            ->leftjoin('agent', 'agentgiveprice.agentid', '=', 'agent.id')
            ->leftjoin('boomt as fromboomt', 'agentgiveprice.fromid', '=', 'fromboomt.id')
            ->leftjoin('boomt as toboomt', 'agentgiveprice.toid', '=', 'toboomt.id')
            ->leftjoin('teeverlegch', 'agentgiveprice.teeverlegchid', '=', 'teeverlegch.id')
            ->leftjoin('containerwagon', 'agentgiveprice.containerwagonid', '=', 'containerwagon.id')
            ->select('agentgiveprice.*',
                'agent.name as agentname',
                'fromboomt.name as fromname',
                'toboomt.name as toname',
                'teeverlegch.name as teeverlegchname',
                'containerwagon.name as containerwagonname')
            ->orderBy('agentgiveprice.actiondate', 'desc')->paginate(10);

        return $agentgivenprice; //DB::table('boomt')->orderBy('name')->get();
    }

    public function getagentaddservice()
    {
        $res = DB::table('nemeltuilchilgee')->get();

        return $res;
    }

    public function getagentgivespricewithdatefilter($datefilter)
    {
        $dateformat = explode('-', $datefilter);

        $datestart = \Carbon\Carbon::create($dateformat[0], $dateformat[1], $dateformat[2], 0, 0, 0);
        $dateend = \Carbon\Carbon::create($dateformat[0], $dateformat[1], $dateformat[2], 23, 59, 59);

        $agentgivenprice = DB::table('agentgiveprice')->where('agentgiveprice.pricetype', 'agentgiveprice')->whereBetween('agentgiveprice.actiondate', array($datestart, $dateend))//->whereRaw('date(agentgiveprice.actiondate) > ? and date(agentgiveprice.actiondate)<?', $datestart,$dateend)
        ->leftjoin('agent', 'agentgiveprice.agentid', '=', 'agent.id')
            ->leftjoin('boomt as fromboomt', 'agentgiveprice.fromid', '=', 'fromboomt.id')
            ->leftjoin('boomt as toboomt', 'agentgiveprice.toid', '=', 'toboomt.id')
            ->leftjoin('teeverlegch', 'agentgiveprice.teeverlegchid', '=', 'teeverlegch.id')
            ->leftjoin('containerwagon', 'agentgiveprice.containerwagonid', '=', 'containerwagon.id')
            ->leftjoin('exchange', 'agentgiveprice.exchangeid', '=', 'exchange.id')
            ->select('agentgiveprice.*',
                'agent.name as agentname',
                'fromboomt.name as fromname',
                'toboomt.name as toname',
                'teeverlegch.name as teeverlegchname',
                'containerwagon.name as containerwagonname',
                'exchange.name as exchangename')
            ->orderBy('agentgiveprice.actiondate', 'desc')->get();

        return $agentgivenprice;
    }

    //*******************************---------- CRUD ---------******************************
    public function PostAgentGivenPrice(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required',
            'angilal' => 'required',
            'customerid' => 'required',
            'teeverlegchid' => 'required',
            'containerwagonid' => 'required',
            'fromteevriinnukhtsulid' => 'required',
            'fromid' => 'required',
            'toteevriinnukhtsulid' => 'required',
            'toid' => 'required',
            'mtzfromid' => 'required',
            'mtztoid' => 'required',
            'mtz_zamhonog' => 'required',
            'tusgai_nuhtsul' => 'required',
            'tariffexpiredate' => 'required',
            'zamhonog' => 'required',
            'exchangeid' => 'required',
        ]);
        $request->offsetUnset('agentprice');
        $requestData = $request->all();

        $requestData['tariffexpiredate'] = Carbon::parse($requestData['tariffexpiredate']);
        $requestData['id'] = (string)Uuid::generate();
        $requestData['created_at'] = Carbon::now();
        $requestData['updated_at'] = Carbon::now();
        $requestData['actiondate'] = Carbon::now();
        $requestData['userid'] = Auth::user()->login;

        DB::table('agentgiveprice')->insert($requestData);

        return response()->json([
            'status' => 'OK',
            'msg' => $requestData,
        ]);
    }

    //*******************************---------- CRUD ---------******************************
    public function PriceCrud(Request $request, $event, $id)
    {
        if ($event == 'first') {
            $firstres = DB::table('agentgiveprice')->where('id', $id)->first();
            $agentgivepricedtl = DB::table('agentgivepricedtl')->where('agentgivepriceid', $firstres->id)->pluck('agentgetpriceid');
            $addserviceids = DB::table('agentgiveprice_add')->where('agentgivepriceid', $firstres->id)->pluck('nemeltuilchilgeeid');

            $agentgivenpricelist = DB::table('agentgiveprice')->where('agentgiveprice.pricetype', 'agentgiveprice')->whereIn('agentgiveprice.id', $agentgivepricedtl)//->whereBetween('agentgiveprice.actiondate', array($datestart, $dateend))//->whereRaw('date(agentgiveprice.actiondate) > ? and date(agentgiveprice.actiondate)<?', $datestart,$dateend)
            ->leftjoin('agent', 'agentgiveprice.agentid', '=', 'agent.id')
                ->leftjoin('boomt as fromboomt', 'agentgiveprice.fromid', '=', 'fromboomt.id')
                ->leftjoin('boomt as toboomt', 'agentgiveprice.toid', '=', 'toboomt.id')
                ->leftjoin('teeverlegch', 'agentgiveprice.teeverlegchid', '=', 'teeverlegch.id')
                ->leftjoin('containerwagon', 'agentgiveprice.containerwagonid', '=', 'containerwagon.id')
                ->leftjoin('exchange', 'agentgiveprice.exchangeid', '=', 'exchange.id')
                ->select('agentgiveprice.*',
                    'agent.name as agentname',
                    'fromboomt.name as fromname',
                    'toboomt.name as toname',
                    'teeverlegch.name as teeverlegchname',
                    'containerwagon.name as containerwagonname',
                    'exchange.name as exchangename')
                ->orderBy('agentgiveprice.actiondate', 'desc')->get();

            $nemeltuilchilgeelist = DB::table('nemeltuilchilgee')->whereIn('id', $addserviceids)->get();

            return response()->json([
                'data' => $firstres, 'agentprice' => $agentgivenpricelist, 'addservice' => $nemeltuilchilgeelist,
            ]);
        } elseif ($event == 'DELETE') {
            $firstres = DB::table('agentgiveprice')->where('id', $id)->delete();

            return response()->json([
                $firstres,
            ]);
        } elseif ($event == 'UPDATE') {
            $validatedData = $request->validate([
                'number' => 'required',
                'angilal' => 'required',
//                'agentid' => 'required',
                'teeverlegchid' => 'required',
                'containerwagonid' => 'required',
                'fromteevriinnukhtsulid' => 'required',
                'fromid' => 'required',
                'toteevriinnukhtsulid' => 'required',
                'toid' => 'required',
                'mtzfromid' => 'required',
                'mtztoid' => 'required',
                'mtz_zamhonog' => 'required',
                'tusgai_nuhtsul' => 'required',
                'tariffexpiredate' => 'required',
                'zamhonog' => 'required',
                'exchangeid' => 'required',
            ]);

            $agentprices = $request->input('agentprice');
            $addservices = $request->input('addservice');

            $request->offsetUnset('agentprice');
            $request->offsetUnset('addservice');

            $updateid = $request->Input('id');

            $requestData = $request->all();

            $requestData['tariffexpiredate'] = Carbon::parse($requestData['tariffexpiredate']);

            $requestData['updated_at'] = Carbon::now();
            $requestData['userid'] = Auth::user()->login;

            $requestData['tariffexpiredate'] = Carbon::parse($requestData['tariffexpiredate']);
            $requestData['updated_at'] = Carbon::now();
            $requestData['userid'] = 'TEsT uSer'; //Auth::user()->login;

            DB::table('agentgiveprice')->where('id', $updateid)->update($requestData);

            DB::table('agentgivepricedtl')->where('agentgivepriceid', $updateid)->delete();
            foreach ($agentprices as $agentprice) {
                $tempid = (string)Uuid::generate();
                DB::table('agentgivepricedtl')->insert(['id' => $tempid, 'agentgivepriceid' => $updateid, 'agentgetpriceid' => $agentprice['id'], 'exchangevalue' => $requestData['exchangevalue'], 'totalamount' => $requestData['totalamount'], 'convertvalue' => $requestData['totalamountfcy']]);
            }
            DB::table('agentgiveprice_add')->where('agentgivepriceid', $updateid)->delete();
            foreach ($addservices as $addservice) {
                $tempid = (string)Uuid::generate();
                DB::table('agentgiveprice_add')->insert(['id' => $tempid, 'agentgivepriceid' => $updateid, 'nemeltuilchilgeeid' => $addservice['id'], 'price' => $addservice['price']]);
            }

            return response()->json([
                'status' => 'OK',
                'msg' => $requestData,
            ]);
        } elseif ($event == 'POST') {
            $validatedData = $request->validate([
                'number' => 'required',
                'angilal' => 'required',
//                'agentid' => 'required',
                'teeverlegchid' => 'required',
                'containerwagonid' => 'required',
                'fromteevriinnukhtsulid' => 'required',
                'fromid' => 'required',
                'toteevriinnukhtsulid' => 'required',
                'toid' => 'required',
                'mtzfromid' => 'required',
                'mtztoid' => 'required',
                'mtz_zamhonog' => 'required',
                'tusgai_nuhtsul' => 'required',
                'tariffexpiredate' => 'required',
                'zamhonog' => 'required',
                'exchangeid' => 'required',
            ]);

            $agentprices = $request->input('agentprice');
            $addservices = $request->input('addservice');

            $request->offsetUnset('agentprice');
            $request->offsetUnset('addservice');

            $requestData = $request->all();

            $requestData['tariffexpiredate'] = Carbon::parse($requestData['tariffexpiredate']);
            $requestData['id'] = (string)Uuid::generate();
            $requestData['created_at'] = Carbon::now();
            $requestData['updated_at'] = Carbon::now();
            $requestData['actiondate'] = Carbon::now();
            $requestData['userid'] = 'TEsT uSer'; //Auth::user()->login;

            DB::table('agentgiveprice')->insertGetId($requestData);
            foreach ($agentprices as $agentprice) {
                $tempid = (string)Uuid::generate();
                DB::table('agentgivepricedtl')->insert(['id' => $tempid, 'agentgivepriceid' => $requestData['id'], 'agentgetpriceid' => $agentprice['id'], 'exchangevalue' => $requestData['exchangevalue'], 'totalamount' => $requestData['totalamount'], 'convertvalue' => $requestData['totalamountfcy']]);
            }
            $ad = [];
            foreach ($addservices as $addservice) {
                array_push($ad, $addservice);
                $tempid = (string)Uuid::generate();
                DB::table('agentgiveprice_add')->insert(['id' => $tempid, 'agentgivepriceid' => $requestData['id'], 'nemeltuilchilgeeid' => $addservice['id'], 'price' => $addservice['price']]);
            }

            return response()->json([
                'status' => 'OK',
                'msg' => $requestData,
                'addservices' => $ad,
                //'msg' => $temper
            ]);
        }

        return response()->json(['status' => $event]);
    }

    public function get_zereglel(Request $request)
    {
        $model = $request->input('model');

        if ($model) {

            $zoriulalt_ids = explode(",", $model['zoriulalt_ids']);
            $options = DB::table('t_togtmol')
                ->where('undsen_id', 41)
                ->whereIn('code', $zoriulalt_ids)
                ->select('id as value', 'ner as label')
                ->get();

            return [
                "schema" => [
                    [
                        "field" => "zereglel_ids",
                        "props" => [
                            'options' => $options
                        ]
                    ]
                ]
            ];
        }
    }
    public function get_bairshil_by_hothon(Request $request)
    {
        $model = $request->input('model');

        if ($model) {

            $hothon_id = $model['hothon_id'];
            $options = DB::table('t_hothon')
                ->where('id', $hothon_id)
                ->first();

            return [
                "schema" => [
//                    [ "field" => "bus_id",
//                        "value"=>$options->bus_id
//                    ],
                    [
                        "field" => "aimag_id",
                        "value" => $options->aimag_id
                    ],
                    ["field" => "sum_duureg_id",
                        "value" => $options->sum_duureg_id
                    ],
                    ["field" => "bag_horoo_id",
                        "value" => $options->bag_horoo_id
                    ],
                    ["field" => "horoolol_id",
                        "value" => $options->horoolol_id
                    ],
                    ["field" => "delgerengui",
                        "value" => $options->bairshil
                    ]
                ]
            ];
        }
    }

}
