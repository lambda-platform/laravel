<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    function getAimag()
    {
        return DB::table('t_aimag')->select('id', 'ner')->get();

    }

    function getSum($id)
    {
        return DB::table('t_sum_duureg')->where('aimag_id', $id)->select('id', 'ner')->get();
    }

    function getConst($id)
    {
        return DB::table('t_togtmol')->where('undsen_id', $id)->get();
    }

    function zereglelTrigger(){
        $ids = request()->get('model')['zoriulalt_ids'];
        dump($ids);
    }
    function getSlideInfoByCountry()
    {
        $data = new \stdClass();
        //$data->today=\Carbon\Carbon::parse('11/01/2018')->format('Y-m-d');
        $data->today=\Carbon\Carbon::now()->format('Y-m-d');
        $user = Auth::user();

        //Niit oron suutsnii too zahialga tuluv-r
        $niitOronSuutsniiTusul = (int)DB::select('select sum(ail_too) as ailtoo from t_barilga where aimag_id=:aimagId and  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids))',['aimagId'=>$user->aimag_id])[0]->ailtoo;// or 221 in (zoriulalt_ids)
        //Ashiglaltad orson
        $niitOronSuutsniiTusulAOrson=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where aimag_id=:aimagId and zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today,'aimagId'=>$user->aimag_id])[0]->ailtoo;
        //Ashiglaltad oroogui
        $niitOronSuutsniiTusulAOroogui=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where aimag_id=:aimagId and  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today,'aimagId'=>$user->aimag_id])[0]->ailtoo;

        $data->niitOronSuutsniiTusul = $niitOronSuutsniiTusul;
        $data->niitOronSuutsniiTusulAOrson = $niitOronSuutsniiTusulAOrson;
        $data->niitOronSuutsniiTusulAOroogui = $niitOronSuutsniiTusulAOroogui;

        //niit ashiglaltd orson borlogdoogui
        $niitOronSuutsniiTusulAOrsonBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where  aimag_id=:aimagId and zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today,'aimagId'=>$user->aimag_id])[0]->ailtoo;
        //niit ashiglaltad oroogui borlogdoogui
        $niitOronSuutsniiTusulAOroohuiBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where aimag_id=:aimagId and  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today,'aimagId'=>$user->aimag_id])[0]->ailtoo;

        $data->niitOronSuutsniiTusulAOrsonBorlogdoogui = $niitOronSuutsniiTusulAOrsonBorlogdoogui;
        $data->niitOronSuutsniiTusulAOrooguiBorlogdoogui = $niitOronSuutsniiTusulAOroohuiBorlogdoogui;
        $data->niitOronSuutsniiNiiluulelt = $niitOronSuutsniiTusulAOroohuiBorlogdoogui + $niitOronSuutsniiTusulAOrsonBorlogdoogui;

        //duuregeer borlogddgui
        $niitOronSuutsniiTusulDuuregBorlogdoogui = DB::select('select sum(shb.borlogdoogui) as borlogdoogui,shb.sum_duureg_id from (select  b.id, b.ail_too, b.aoroh_ognoo, b.sum_duureg_id, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoogui
        from t_barilga as b
        where aimag_id=:aimagId and  (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.zahialga_tuluv>452 and b.zahialga_tuluv<457 and b.aimag_id=22) as shb group by shb.sum_duureg_id',['aimagId'=>$user->aimag_id]);

        //$niitOronSuutsniiTusulDuuregBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today])[0]->ailtoo;


        $data->duureg = [];
        if($niitOronSuutsniiTusulDuuregBorlogdoogui) {
            foreach ($niitOronSuutsniiTusulDuuregBorlogdoogui as $d) {
                $item = new \stdClass();

                $duureg = DB::table('t_sum_duureg')->where('id', $d->sum_duureg_id)->first();
                $item->type = "circle";
                $item->width = 5;
                $item->height = 5;
                $item->labelShiftY = ($duureg->id == 136 || $duureg->id == 135) ? -5 : 8;
                $item->labelColor = "#2f3542";
                $item->latitude = $duureg->lat;
                $item->longitude = $duureg->lng;
                $item->label = $duureg->ner . "-" . $d->borlogdoogui;
                $item->color = "#fff";

                //$item->balloonText = "\n<h4 class='title'>Багахангай</h4><table class='popup'>\n<tr><td>Орон сууцны тоо</td><td> &nbsp;15 </td></tr>\n <tr><td>Айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдсон айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдоогүй айлын тоо</td><td> &nbsp;0</td></tr>\n </table>",

                array_push($data->duureg, $item);
            }
        }

        //zeregleleer
        $niitOronSuutsniiTusulZereglelBorlogdoogui = DB::select('select sum(shb.borlogdoogui)  as borlogdoogui,
        shb.ner from (select
         b.id, t.ner, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoogui
        from t_barilga b
        left join t_togtmol t on t.id=b.zereglel_ids 
        where aimag_id=:aimagId and (4 in (b.zoriulalt_ids)) and  b.zahialga_tuluv>452 and b.zahialga_tuluv<457) as shb group by shb.ner',['aimagId'=>$user->aimag_id]);

        $data->niitOronSuutsniiTusulZereglelBorlogdoogui = $niitOronSuutsniiTusulZereglelBorlogdoogui;

        //uruunii bolon uruunii toogoor hemjeegeer
        $niitOronSuutsniiTusulTalbaiBorlogdoogui = DB::select('select
        o.barilga_id,o.talbai,t.ner,ifnull(o.too,0)-ifnull(o.borlogdson_too,0) as borlogdoogui
        from t_barilga b
        left join t_barilga_object o on o.barilga_id=b.id  
        left join t_togtmol t on t.id=o.uruu_id 
        where aimag_id=:aimagId and (4 in (b.zoriulalt_ids)) and b.zahialga_tuluv>452 and b.zahialga_tuluv<457 and ifnull(o.too,0)-ifnull(o.borlogdson_too,0)>0',['aimagId'=>$user->aimag_id]);
        $data->niitOronSuutsniiTusulTalbaiBorlogdoogui = $niitOronSuutsniiTusulTalbaiBorlogdoogui;

        return response()->json($data);
    }

    function getSlideInfo()
    {
        $data = new \stdClass();
        $data->today=\Carbon\Carbon::now()->format('Y-m-d');

        //Niit oron suutsnii too zahialga tuluv-r
        $niitOronSuutsniiTusul = (int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where  (zahialga_tuluv=453 or (zahialga_tuluv=454 and (ashiglaagui_tuluv_id!=392 or ashiglaagui_tuluv_id is null))or (zahialga_tuluv=455 and ashiglaagui_tuluv_id!=392)) and (4 in(zoriulalt_ids)) and aimag_id=22')[0]->ailtoo;// or 221 in (zoriulalt_ids)
        //Ashiglaltad orson
        $niitOronSuutsniiTusulAOrson=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where (zahialga_tuluv=453 or (zahialga_tuluv=454 and (ashiglaagui_tuluv_id!=392 or ashiglaagui_tuluv_id is null))or (zahialga_tuluv=455 and ashiglaagui_tuluv_id!=392)) and (4 in(zoriulalt_ids)) and aimag_id=22 and aoroh_ognoo<:today',['today'=>$data->today])[0]->ailtoo;
        //Ashiglaltad oroogui
        $niitOronSuutsniiTusulAOroogui=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where  (zahialga_tuluv=453 or (zahialga_tuluv=454 and (ashiglaagui_tuluv_id!=392 or ashiglaagui_tuluv_id is null))or (zahialga_tuluv=455 and ashiglaagui_tuluv_id!=392)) and (4 in(zoriulalt_ids)) and aimag_id=22 and aoroh_ognoo>=:today',['today'=>$data->today])[0]->ailtoo;

        $data->niitOronSuutsniiTusul = $niitOronSuutsniiTusul;
        $data->niitOronSuutsniiTusulAOrson = $niitOronSuutsniiTusulAOrson;
        $data->niitOronSuutsniiTusulAOroogui = $niitOronSuutsniiTusulAOroogui;

       //niit ashiglaltd orson borlogdoogui
        $niitOronSuutsniiTusulAOrsonBorlogdoogui=(int)DB::select('select  sum(ifnull(uldegdel,0)) as ailtoo from t_barilga where  (zahialga_tuluv=453 or (zahialga_tuluv=454 and (ashiglaagui_tuluv_id!=392 or ashiglaagui_tuluv_id is null))or (zahialga_tuluv=455 and ashiglaagui_tuluv_id!=392)) and aimag_id=22 and (4 in(zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today])[0]->ailtoo;
        //niit ashiglaltad oroogui borlogdoogui
        $niitOronSuutsniiTusulAOroohuiBorlogdoogui=(int)DB::select('select  sum(ifnull(uldegdel,0)) as ailtoo from t_barilga where  (zahialga_tuluv=453 or (zahialga_tuluv=454 and (ashiglaagui_tuluv_id!=392 or ashiglaagui_tuluv_id is null))or (zahialga_tuluv=455 and ashiglaagui_tuluv_id!=392)) and aimag_id=22 and (4 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today])[0]->ailtoo;

        $data->niitOronSuutsniiTusulAOrsonBorlogdoogui = $niitOronSuutsniiTusulAOrsonBorlogdoogui;
        $data->niitOronSuutsniiTusulAOrooguiBorlogdoogui = $niitOronSuutsniiTusulAOroohuiBorlogdoogui;
        $data->niitOronSuutsniiNiiluulelt = $niitOronSuutsniiTusulAOroohuiBorlogdoogui + $niitOronSuutsniiTusulAOrsonBorlogdoogui;

        //duuregeer borlogddgui
        $niitOronSuutsniiTusulDuuregBorlogdoogui = DB::select('select sum(shb.ail_too) as borlogdoogui,shb.sum_duureg_id
        from (select  b.id, b.ail_too, b.aoroh_ognoo, b.sum_duureg_id, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoogui
        from t_barilga as b
        where  (4 in (b.zoriulalt_ids)) and b.zahialga_tuluv=453  and b.aimag_id=22) as shb group by shb.sum_duureg_id');

        //$niitOronSuutsniiTusulDuuregBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today])[0]->ailtoo;


        $data->duureg = [];
        if($niitOronSuutsniiTusulDuuregBorlogdoogui) {
            foreach ($niitOronSuutsniiTusulDuuregBorlogdoogui as $d) {
                $item = new \stdClass();

                $duureg = DB::table('t_sum_duureg')->where('id', $d->sum_duureg_id)->first();
                $item->type = "circle";
                $item->width = 5;
                $item->height = 5;
                $item->labelShiftY = ($duureg->id == 136 || $duureg->id == 135) ? -5 : 8;
                $item->labelColor = "#2f3542";
                $item->latitude = $duureg->lat;
                $item->longitude = $duureg->lng;
                $item->label = $duureg->ner . "-" . $d->borlogdoogui;
                $item->color = "#fff";

                //$item->balloonText = "\n<h4 class='title'>Багахангай</h4><table class='popup'>\n<tr><td>Орон сууцны тоо</td><td> &nbsp;15 </td></tr>\n <tr><td>Айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдсон айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдоогүй айлын тоо</td><td> &nbsp;0</td></tr>\n </table>",

                array_push($data->duureg, $item);
            }
        }

        //zeregleleer
        $niitOronSuutsniiTusulZereglelBorlogdoogui = DB::select('select sum(shb.borlogdoogui)  as borlogdoogui,
        shb.ner from (select
         b.id, t.ner, ifnull(b.ail_too,0) as borlogdoogui
        from t_barilga b
        left join t_togtmol t on t.id=b.zereglel_ids 
        where(4 in (b.zoriulalt_ids)) and  b.zahialga_tuluv=453 and b.aimag_id=22) as shb group by shb.ner');

        $data->niitOronSuutsniiTusulZereglelBorlogdoogui = $niitOronSuutsniiTusulZereglelBorlogdoogui;

        //uruunii bolon uruunii toogoor hemjeegeer
        $niitOronSuutsniiTusulTalbaiBorlogdoogui = DB::select('select
        o.barilga_id,o.talbai,t.ner,ifnull(o.too,0) as borlogdoogui
        from t_barilga b
        left join t_barilga_object o on o.barilga_id=b.id  
        left join t_togtmol t on t.id=o.uruu_id 
        where (4 in (b.zoriulalt_ids)) and b.zahialga_tuluv=453 and b.aimag_id=22 and ifnull(o.too,0)>0');


        $data->niitOronSuutsniiTusulTalbaiBorlogdoogui = $niitOronSuutsniiTusulTalbaiBorlogdoogui;

        return response()->json($data);
    }
    function getSlideInfoOld()
    {
        $data = new \stdClass();
        $data->today=\Carbon\Carbon::parse('11/01/2018')->format('Y-m-d');
        //$data->today=\Carbon\Carbon::now()->format('Y-m-d');
        //'2018-1-30';
        //niit oron suutsnii tusul _old
        //        $niitOronSuutsniiTusul = (int)DB::select('select sum(pb.borlogdoh) as ailtoo
        //from (select distinct b1.barilga_id, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoh from t_une as b1
        //left join t_barilga b on b.id=b1.barilga_id where (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\') as pb')[0]->ailtoo;
        //niit oron suutsnii tusul _NEW
        $niitOronSuutsniiTusul = (int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids))')[0]->ailtoo;// or 221 in (zoriulalt_ids)

        //$niitOronSuutsniiTusulAOrson = (int)DB::select('select sum(pb.ail_too) as ailtoo
        //from (select distinct b1.barilga_id, b.ail_too from t_une as b1
        //left join t_barilga b on b.id=b1.barilga_id where  (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\' and b.aoroh_ognoo<:today) as pb',['today'=>$data->today])[0]->ailtoo;
        $niitOronSuutsniiTusulAOrson=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today])[0]->ailtoo;

        //$niitOronSuutsniiTusulAOroogui = $niitOronSuutsniiTusul - $niitOronSuutsniiTusulAOrson;
        $niitOronSuutsniiTusulAOroogui=(int)DB::select('select  sum(ail_too) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in(zoriulalt_ids) or 221 in(zoriulalt_ids)) and aoroh_ognoo>=:today',['today'=>$data->today])[0]->ailtoo;

        //$niitOronSuutsniiTusulBorlogdoogui = (int)DB::select('select sum(ifnull(pb.ail_too,0)-ifnull(pb.borlogdson_too,0)) as ailtoo
        //from (select distinct b1.barilga_id, b.ail_too,b.borlogdson_too from t_une as b1
        //left join t_barilga b on b.id=b1.barilga_id where  (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\') as pb')[0]->ailtoo;

        $niitOronSuutsniiTusulBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in (zoriulalt_ids) or 221 in (zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today])[0]->ailtoo;


        //$niitOronSuutsniiTusulAOrsonBorlogdoogui = (int)DB::select('select sum(ifnull(pb.ail_too,0)-ifnull(pb.borlogdson_too,0)) as ailtoo
        //from (select distinct b1.barilga_id, b.ail_too,b.borlogdson_too from t_une as b1
        //left join t_barilga b on b.id=b1.barilga_id where  (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\' and b.aoroh_ognoo<:today) as pb',['today'=>$data->today])[0]->ailtoo;

        $niitOronSuutsniiTusulAOrsonBorlogdoogui=(int)DB::select('select  sum(ifnull(ail_too,0)-ifnull(borlogdson_too,0)) as ailtoo from t_barilga where  zahialga_tuluv>452 and zahialga_tuluv<457 and (4 in (zoriulalt_ids) or 221 in (zoriulalt_ids)) and aoroh_ognoo<:today',['today'=>$data->today])[0]->ailtoo;

        $data->niitOronSuutsniiTusul = $niitOronSuutsniiTusul;
        $data->niitOronSuutsniiTusulAOrson = $niitOronSuutsniiTusulAOrson;
        $data->niitOronSuutsniiTusulAOroogui = $niitOronSuutsniiTusulAOroogui;

        $data->niitOronSuutsniiTusulAOrsonBorlogdoogui = $niitOronSuutsniiTusulAOrsonBorlogdoogui;
        $data->niitOronSuutsniiTusulAOrooguiBorlogdoogui = $niitOronSuutsniiTusulBorlogdoogui - $niitOronSuutsniiTusulAOrsonBorlogdoogui;
        $data->niitOronSuutsniiNiiluulelt = $niitOronSuutsniiTusulAOrsonBorlogdoogui + $data->niitOronSuutsniiTusulAOrooguiBorlogdoogui;

        //duuregeer borlogddgui
        $niitOronSuutsniiTusulDuuregBorlogdoogui = DB::select('select sum(shb.borlogdoogui) as borlogdoogui,shb.sum_duureg_id
        from (select distinct b1.barilga_id, b.ail_too, b.aoroh_ognoo, b.sum_duureg_id, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoogui
        from t_une as b1
        left join t_barilga b on b.id=b1.barilga_id
        where  (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\' and b.aimag_id=22) as shb group by shb.sum_duureg_id');

        $data->duureg = [];
        foreach ($niitOronSuutsniiTusulDuuregBorlogdoogui as $d) {
            $item = new \stdClass();

            $duureg = DB::table('t_sum_duureg')->where('id', $d->sum_duureg_id)->first();
            $item->type = "circle";
            $item->width = 5;
            $item->height = 5;
            $item->labelShiftY = ($duureg->id == 136 || $duureg->id == 135) ? -5 : 8;
            $item->labelColor = "#2f3542";
            $item->latitude = $duureg->lat;
            $item->longitude = $duureg->lng;
            $item->label = $duureg->ner . "-" . $d->borlogdoogui;
            $item->color = "#fff";

            //$item->balloonText = "\n<h4 class='title'>Багахангай</h4><table class='popup'>\n<tr><td>Орон сууцны тоо</td><td> &nbsp;15 </td></tr>\n <tr><td>Айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдсон айлын тоо</td><td> &nbsp;530</td></tr>\n <tr><td>Борлогдоогүй айлын тоо</td><td> &nbsp;0</td></tr>\n </table>",

            array_push($data->duureg, $item);
        }

        //zeregleleer

        $niitOronSuutsniiTusulZereglelBorlogdoogui = DB::select('select sum(shb.borlogdoogui)  as borlogdoogui,shb.ner from (select
        distinct b1.barilga_id, t.ner, ifnull(b.ail_too,0)-ifnull(b.borlogdson_too,0) as borlogdoogui
        from t_une as b1
        left join t_barilga b on b.id=b1.barilga_id
        left join t_togtmol t on t.id=b.zereglel_ids 
        where(4 in (b.zoriulalt_ids)) and not(221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\') as shb group by shb.ner');

        $data->niitOronSuutsniiTusulZereglelBorlogdoogui = $niitOronSuutsniiTusulZereglelBorlogdoogui;

        //uruunii bolon uruunii toogoor hemjeegeer
        $niitOronSuutsniiTusulTalbaiBorlogdoogui = DB::select('select
        o.barilga_id,o.talbai,t.ner,ifnull(o.too,0)-ifnull(o.borlogdson_too,0) as borlogdoogui
        from t_une as b1 left join t_barilga b on b.id=b1.barilga_id
        left join t_barilga_object o on o.id=b1.object_id  
        left join t_togtmol t on t.id=o.uruu_id 
        where (4 in (b.zoriulalt_ids) or 221 in (b.zoriulalt_ids)) and b.aoroh_ognoo>\'2016-01-01\' and ifnull(o.too,0)-ifnull(o.borlogdson_too,0)>0');
        $data->niitOronSuutsniiTusulTalbaiBorlogdoogui = $niitOronSuutsniiTusulTalbaiBorlogdoogui;

        return response()->json($data);
    }
}
