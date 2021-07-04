<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    function pivot()
    {

        $col = request()->get('col');
        $row = request()->get('row');

        $data = [];
        $colHeader = [];

        //$qr = $this->appendFilter($qr);

        //Pivot Start here
//        $hasColumn = false;
//        $col = request()->get('col');
//        if ($col && $col != null) {
//            $hasColumn = true;
//        }



        $rowCond = $this->setPivotCondition($row);
        if ($rowCond['type'] == 'table') {
            $rowData = DB::table($rowCond['table']);
            if (isset($rowCond['dataCondition'])) {
                $rowData->whereRaw($rowCond['dataCondition']);
            }
            $rowData = $rowData->get();
        } else {
            $rowData = $rowCond['data'];
        }

        $rowNameField = $rowCond['nameField'];
        $tableTitle = $rowCond['title'];
        array_push($colHeader, $tableTitle);

        //If columns is declared
        $colData = [];
        if ($col && $col != null) {
            $colCond = $this->setPivotCondition($col);
            if ($colCond['type'] == 'table') {
                $colData = DB::table($colCond['table']);
                if (isset($colCond['dataCondition'])) {
                    $colData->whereRaw($colCond['dataCondition']);
                }
                $colData = $colData->get();
            } else {
                $colData = $colCond['data'];
            }
            $colNameField = $colCond['nameField'];
            $tableTitle = $rowCond['title'] . "/" . $colCond['title'];
            foreach ($colData as $c) {
                array_push($colHeader, $c->$colNameField);
            }
        }

        $rin = 0;
        foreach ($rowData as $r) {
            $arr = [];
            $arr[0] = $r->$rowNameField;

            if ($col && $col != null) {
                //when in pivot mode
                foreach ($colData as $c) {
                    $qrc = DB::table('t_barilga as b');
                    //->where('zahialga_tuluv', 453);
                    $qrc = $this->appendFilter($qrc);
                    $compareAliasRow = 'b';
                    $compareAliasCol = 'b';

                    //Checking row
                    switch ($rowCond['comparison']) {
                        case 'equal':
                            {
                                $rowCompare = $rowCond['bCompareField'];
                                $rowCompareVal = $rowCond['compareField'];
                                $qrc->where($compareAliasRow . '.' . $rowCompare, $r->$rowCompareVal);
                                break;
                            }
                        case 'multiSum':
                            $qrc = $qrc->select($rowCond['bCompareField'][$rin]);
                            break;
                        case 'contain':
                            $rowCompare = $rowCond['bCompareField'];
                            $rowCompareVal = $rowCond['compareField'];
                            $qrc->where($compareAliasRow . '.' . $rowCompare, $r->$rowCompareVal);
                            if (is_array($r->$rowCompareVal) && in_array(null, $r->$rowCompareVal, true)) {
                                $qrc->orWhereNull($compareAliasRow . '.' . $rowCompare);
                            };
                            break;
                        default:
                            break;
                    }

                    //Checking column
                    switch ($colCond['comparison']) {
                        case 'equal':
                            {
                                $colCompare = $colCond['bCompareField'];
                                $colCompareVal = $colCond['compareField'];
                                $qrc->where($compareAliasCol . '.' . $colCompare, $c->$colCompareVal);
                                break;
                            }
                        case 'contain':
                            $colCompare = $colCond['bCompareField'];
                            $colCompareVal = $colCond['compareField'];
                            $qrc->where($compareAliasCol . '.' . $colCompare, $r->$colCompareVal);
                            if (is_array($r->$colCompareVal) && in_array(null, $r->$colCompareVal, true)) {
                                $qrc->orWhereNull($compareAliasCol . '.' . $colCompare);
                            };
                            break;
                        default:
                            break;
                    }

                    if ($rowCond['comparison'] != 'multiSum') {
                        if (request()->get('countType') == 0) {
                            array_push($arr, $qrc->sum('b.ail_too'));
                        } else {
                            array_push($arr, $qrc->count());
                        }
                    }else{
                        array_push($arr, $qrc->sum($rowCond['bCompareField'][$rin]));
                    }
                }
            } //When only row
            else {
                $qrr = DB::table('t_barilga as b')
                    ->where('zahialga_tuluv', 453);
                $qrr = $this->appendFilter($qrr);
                $compareAlias = 'b';

                switch ($rowCond['comparison']) {
                    case 'equal':
                        $rowCompare = $rowCond['bCompareField'];
                        $rowCompareVal = $rowCond['compareField'];
                        $qrr->where($compareAlias . '.' . $rowCompare, $r->$rowCompareVal);
                        break;

                    case 'multiSum':
                        $qrr = $qrr->select($rowCond['bCompareField'][$rin]);
                        break;

                    case 'contain':
                        $rowCompare = $rowCond['bCompareField'];
                        $rowCompareVal = $rowCond['compareField'];
                        $qrr->where($compareAlias . '.' . $rowCompare, $r->$rowCompareVal);
                        if (is_array($r->$rowCompareVal) && in_array(null, $r->$rowCompareVal, true)) {
                            $qrr->orWhereNull($compareAlias . '.' . $rowCompare);
                        };
                        break;

                    case 'sum':
                        break;
                }

                if ($rowCond['comparison'] != 'multiSum') {
                    if (request()->get('countType') == 0) {
                        array_push($arr, $qrr->sum('b.ail_too'));
                    } else {
                        array_push($arr, $qrr->count());
                    }
                } else {
                    array_push($arr, $qrr->sum($rowCond['bCompareField'][$rin]));
                }
            }

            $rin++;
            array_push($data, $arr);
        }


        return response()->json(['data' => $data, 'header' => $colHeader]);

    }

    function appendFilter($qr)
    {
        //Filters
        $aimag = request()->get('aimag');
        if ($aimag && $aimag != null) {
            $qr = $qr->where('b.aimag_id', $aimag);
        }

        $sum = request()->get('sum');
        if ($sum && $sum != null) {
            $qr = $qr->where('b.sum_duureg_id', $sum);
        }

        $start = request()->get('start');
        if ($start && $start != null) {
            $qr = $qr->where('b.aoroh_ognoo', '>=', $start);
        }

        $end = request()->get('end');
        if ($end && $end != null) {
            $qr = $qr->where('b.aoroh_ognoo', '<=', $end);
        }

        $zahialgaTuluv= request()->get('zahialgaTuluv');
        if ($zahialgaTuluv && $zahialgaTuluv != null) {
            $qr = $qr->where('b.zahialga_tuluv', $zahialgaTuluv);
        }

        return $qr;
    }

    function setPivotCondition($type)
    {
        $conData = [];
        switch ($type) {
            case 'type':
                $data = [];
                $c = ['Нийтийн ос', 'Амины ос'];

                for ($i = 0; $i < count($c); $i++) {
                    $obj = new \stdClass();
                    if ($i == 0) {
                        $obj->id = 0;
                    } else {
                        $obj->id = 1;
                    }
                    $obj->type = $c[$i];
                    array_push($data, $obj);
                }


                $conData = [
                    'data' => $data,
                    'title' => 'Орон сууц',
                    'type' => 'data',
                    'nameField' => 'type', // haritsuulah husnegtiin haragdah ner
                    'bCompareField' => 'is_house', //undsen husnegtiin haritsuulah talbar
                    'compareField' => 'id', // haritsuulah husnegtiin talbar
                    'comparison' => 'equal' // haritsuulah nuhtsul
                ];
                break;
            case 'room':
                $data = [];
                $c = ['1 өрөө', '2 өрөө', '3 өрөө', '4 өрөө', '5 өрөө', '6,7 өрөө', 'Дуплекс'];
                $c1 = ['uruu_1', 'uruu_2', 'uruu_3', 'uruu_4', 'uruu_5', 'uruu_6_7', 'duplex'];
//                $uruu = DB::table('view_uruu')->get();

                for ($i = 0; $i < count($c); $i++) {
                    $obj = new \stdClass();
                    $obj->id = $i;
                    $obj->uruu = $c[$i];
                    $obj->field = $c[$i];
                    array_push($data, $obj);
                }

                $conData = [
                    'data' => $data,
                    'title' => 'Өрөөний тоо',
                    'type' => 'data',
                    'nameField' => 'uruu', // haritsuulah husnegtiin haragdah ner
                    'bCompareField' => $c1, //undsen husnegtiin haritsuulah talbar
                    'compareField' => 'id', // haritsuulah husnegtiin talbar
                    'comparison' => 'multiSum' // haritsuulah nuhtsul
                ];
                break;

            case 'hiits':
                $conData = [
                    'title' => 'Барилгын хийц',
                    'type' => 'table',
                    'table' => 't_togtmol',
                    'nameField' => 'ner',
                    'bCompareField' => 'hiits_id',
                    'compareField' => 'id',
                    'comparison' => 'equal',
                    'dataCondition' => 'undsen_id = 13'
                ];
                break;

            case 'zereglel':

                $btype = request()->get('btype');
                if ($btype && $btype != null) {
                    $conData = [
                        'title' => 'Зэрэглэл',
                        'type' => 'table',
                        'table' => 't_togtmol',
                        'nameField' => 'ner',
                        'bCompareField' => 'zereglel_ids',
                        'compareField' => 'id',
                        'comparison' => 'equal',
                        'dataCondition' => 'undsen_id = 41 and code = ' . $btype
                    ];
                } else {
                    $conData = [
                        'title' => 'Зэрэглэл',
                        'type' => 'table',
                        'table' => 't_togtmol',
                        'nameField' => 'ner',
                        'bCompareField' => 'zereglel_ids',
                        'compareField' => 'id',
                        'comparison' => 'equal',
                        'dataCondition' => 'undsen_id = 41'
                    ];
                }

                break;
        }

        return $conData;
    }
}
