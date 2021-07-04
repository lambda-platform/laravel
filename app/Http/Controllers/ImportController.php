<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Classes\Summary;
use App\Http\Models\Aimag;
use App\Http\Models\BagHoroo;
use App\Http\Models\Barilga;
use App\Http\Models\BarilgaDetail;
use App\Http\Models\BarilgaObject;
use App\Http\Models\Company;
use App\Http\Models\Horoolol;
use App\Http\Models\Hothon;
use App\Http\Models\ShineBarilga;
use App\Http\Models\SumDuureg;
use App\Http\Models\Togtmol;
use App\Http\Models\TogtmolTurul;
use App\Http\Models\Une;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

define('EMPTY_REQUIRED_FIELD', 'Заавал оруулах талбар хоосон байна');
define('NOT_IN_DB', 'Сонголтонд байхгүй өгөгдөл байна');

class ImportController extends Controller
{
    const ValidExtensions = ['xlsx'];

    private $file;

    public function __construct()
    {
    }

    public function downloadOSLink()
    {
        return Storage::download(
            'Oron_suuts_template.xlsx'
        );
    }

    public function downloadOSSimpleLink()
    {
        return \Storage::download(
            'Oron_suuts_template_simple.xlsx'
        );
    }

    public function downloadOSReportLink()
    {
        return \Storage::download(
            'OS_report_template.xlsx'
        );
    }

    public function downloadOSObjectLink()
    {
        return \Storage::download(
            DIRECTORY_SEPARATOR.'Oron_suuts_uruunii_songolt_template.xlsx'
        );
    }

    public function downloadCompanyLink()
    {
        return \Storage::download(
            DIRECTORY_SEPARATOR.'Company_template.xlsx'
        );
    }

    public function importOS(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();

            $summary = new Summary($request->file('file')->getClientOriginalName());

            $data = Excel::load($path, function ($reader) {
                $reader->skipRows(5);
            })->get();

            if (!empty($data) && $data->count()) {
                try {
                    $tmp = ($data[0]->id);
                } catch (\Exception $e) {
                    $summary->addStructureIssue('Файл нь 1 л хуудастай /sheet/ байх ёстой',
                        '');

                    return json_encode($summary);
                }

                DB::transaction(function () use ($request, $data, $summary) {
                    $barilgas = [];

                    foreach ($data as $key => $value) {
                        $cellName = 'Мөр:'.($key + 7).', Багана:';

                        /*initial*/
                        $barilga = null;
                        $isNew = false;

                        if ($value->id) {
                            try {
                                $barilga = Barilga::findOrFail($value->id);
                                $barilga->excel_update= Carbon::now();

                            } catch (\Exception $e) {
                                $summary->addStructureIssue('Ийм ID-тай барилга байхгүй байна',
                                    $cellName.'id {'.$value->id.'}');

                                return json_encode($summary);
                            }
                        } else {
                            $barilga = new Barilga();
                            $barilga->excel_insert= Carbon::now();
                            $barilga->is_imported = true;
                            $isNew = true;
                        }

                        $barilga->zoriulalt_ids = Togtmol::ORON_SUUTS;

                        if ($value->ner) {
                            if ($value->ner == '-' ||
                                $value->ner == ' ' ||
                                $value->ner == '0') {
                                $this->emptyRequired('ner', $cellName, $summary);
                            } else {
                                $barilga->ner = $value->ner;
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired('ner', $cellName, $summary);
                        }

                        if ($value->english) {
                            $barilga->ner_eng = $value->english;
                        }

                        $colname = 'aimag';
                        if ($value->{$colname}) {
                            $aimag = Aimag::whereNer(str_replace(' аймаг', '', $value->{$colname}))->first(['id']);
                            if ($aimag) {
                                $barilga->aimag_id = $aimag->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй аймаг, нийслэл байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname.'', $cellName, $summary);
                        }

                        $colname = 'sum_duureg';
                        if ($value->{$colname}) {
                            $sum_duureg = SumDuureg::whereAimagId($barilga->aimag_id)
                                ->where('ner', str_replace(' сум', '', $value->{$colname}))->first(['id']);
                            if ($sum_duureg) {
                                $barilga->sum_duureg_id = $sum_duureg->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй сум, дүүрэг байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'bag_horoo';
                        if ($value->{$colname}) {
                            $bag_horoo = BagHoroo::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where(function ($query) use ($value, $colname) {
                                    $query->where('ner', $value->{$colname}.'-р хороо')
                                        ->orWhere('ner', $value->{$colname}.'-р баг')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'\'')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'  баг\'')
                                        ->orWhere('ner', $value->{$colname});
                                })->first(['id']);

                            if ($bag_horoo) {
                                $barilga->bag_horoo_id = $bag_horoo->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй баг, хороо байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'horoolol';
                        if ($value->{$colname}) {
                            $horoolol = Horoolol::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id', 'bus_id']);
                            if ($horoolol) {
                                $barilga->bus_id = $horoolol->bus_id;
                                $barilga->horoolol_id = $horoolol->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хороолол байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew && $barilga->aimag_id == 22) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        if ($barilga->aimag_id != 22) {
                            $barilga->bus_id = Togtmol::ORON_NUTAG;
                        }

                        $colname = 'hothon';
                        if ($value->{$colname}) {
                            $hothon = Hothon::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id']);
                            if ($hothon) {
                                $barilga->hothon_id = $hothon->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хотхон байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        }
//                        elseif ($isNew && $barilga->aimag_id == 22) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }

                        //davhardal baigaa esehiig shalgana. umnu iim bair baival aldaa butsaana
                        if ($isNew && $this->getBarilgaFromAddress($barilga->ner, $barilga->aimag_id,
                            $barilga->sum_duureg_id, $barilga->bag_horoo_id,
                            $barilga->horoolol_id, $barilga->hothon_id)) {
                            $summary->addStructureIssue('Ийм нэр, дугаар, хаяг бүхий барилга аль хэдийн бүртгэгдсэн байна',
                                $cellName);

                            return json_encode($summary);
                        }
                        $colname = 'gudamj';
                        if ($value->{$colname}) {
                            $barilga->gudamj = $value->{$colname};
                        }

                        $colname = 'bairshil';
                        if ($value->{$colname}) {
                            $barilga->bairshil = $value->{$colname};
                        }

                        $colname = 'zipcode';
                        if ($value->{$colname}) {
                            $zipcode = $value->{$colname};

                            if (strlen($zipcode) == 5) {
                                $barilga->zipcode = $zipcode;
                            } else {
                                $summary->addStructureIssue('zipcode буруу байна',
                                    $cellName);
                            }
                        }

                        $colname = 'latlong';
                        if ($value->{$colname} && strlen($value->{$colname})>2) {
                            $arrays = explode(', ', $value->{$colname});
                            if (count($arrays) != 2) {
                                $arrays = explode(',', $value->{$colname});
                            }
                            if (count($arrays) != 2) {
                                $arrays = explode(' ', $value->{$colname});
                            }
                            if (count($arrays) != 2) {
                                $arrays = explode('  ', $value->{$colname});
                            }
                            if (count($arrays) != 2) {
                                $arrays = explode('   ', $value->{$colname});
                            }
                            if (count($arrays) != 2) {
                                $arrays = explode('/', $value->{$colname});
                            }
                            if (count($arrays) != 2) {
                                $arrays = explode(' / ', $value->{$colname});
                            }

                            if (count($arrays) == 2 && $this->isValidLatLong($arrays[0], $arrays[1])) {
                                $barilga->longtitude = '{"lat":"'.$arrays[0].'","lng":"'.$arrays[1].'"}';
                            } else {
                                $summary->addStructureIssue('Уртраг, өргөрөг буруу байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        }

                        $colname = 'tuluv';
                        if ($value->{$colname}) {
                            $barilga->is_active = $this->getBooleanVal($value->{$colname}, $cellName, $colname, $summary);
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'ashiglagdaagui_tuluv';
                        if ($value->{$colname}) {
                            $barilga->ashiglaagui_tuluv_id = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::ASHILAGDAAGUI_TULUV, $cellName, $colname, $summary);
                        } elseif ($isNew && !$barilga->is_active) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'ashiglalt_baidal';
                        if ($value->{$colname}) {
                            $barilga->ashiglalt_id
                                = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::ASHIGLALT_BAIDAL, $cellName, $colname, $summary);
                        }


                        $colname = 'aorson_ognoo';
                        if ($value->{$colname}) {
                            $barilga->aorson_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
                        }


                        $colname = 'avg_mkv_une';
                        if ($value->avg_mkv_une || $value->garage_une) {

                            $barilga->uneTmp = new Une();
                            $barilga->uneTmp->addDate = $barilga->aorson_ognoo;
                            $barilga->uneTmp->currencyID =1;
                            $barilga->uneTmp->UnitPrice = doubleval($value->avg_mkv_une);
                            $barilga->uneTmp->garagePrice = doubleval($value->garage_une);

                        }

                        $colname = 'zahialga_tuluv';
                        if ($value->{$colname}) {
                            $barilga->zahialga_tuluv = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::ZAHIALGA_TULUV, $cellName, $colname, $summary);
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'hiits';
                        if ($value->{$colname}) {
                            $barilga->hiits_id = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::BARILGA_HIITS, $cellName, $colname, $summary);
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }


                        $colname = 'zereglel';
                        //dump($value);
                        if ($value->zereglel) {
                            //dump($value->{$colname});
                            $tempZereglel=explode(",",$value->{$colname});
                            //dd($tempZereglel);
                            $tempZereglelIds='';
                            $counter=0;
                            foreach ($tempZereglel as $tzer)
                            {
                                if($counter>0)
                                {
                                    $tempZereglelIds=$tempZereglelIds.", ";
                                }
                                $tempZereglelIds=$tempZereglelIds.$this->getSingleTogtmol($tzer,
                                TogtmolTurul::BARILGA_ZEREGLEL, $cellName, $colname, $summary);
                                $counter++;
                            }

                            //$barilga->zereglel_ids= $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::BARILGA_ZEREGLEL, $cellName, $colname, $summary);
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'davhar';
                        if ($value->{$colname}) {
                            if(is_numeric($value->{$colname})) {
                                $barilga->davhar_too = intval($value->{$colname});
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'ho_uls';
                        if ($value->{$colname}) {
                            $barilga->hurunguOruulagchUls = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::ULS_NER, $cellName, $colname, $summary);
                        }

                        $colname = 'ail_too';
                        if (is_numeric($value->{$colname})) {
                            $barilga->ail_too = intval($value->{$colname});
                        }

                        $colname = 'uldegdel';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uldegdel = intval($value->{$colname});
                        }

                        $colname = 'uruu_1';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_1 = intval($value->{$colname});
                        }

                        $colname = 'uruu_2';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_2 = intval($value->{$colname});
                        }

                        $colname = 'uruu_3';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_3 = intval($value->{$colname});
                        }

                        $colname = 'uruu_4';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_4 = intval($value->{$colname});
                        }

                        $colname = 'uruu_5';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_5 = intval($value->{$colname});
                        }

                        $colname = 'uruu_6_7';
                        if (is_numeric($value->{$colname})) {
                            $barilga->uruu_6_7 = intval($value->{$colname});
                        }

                        $colname = 'duplex';
                        if (is_numeric($value->{$colname})) {
                            $barilga->duplex = intval($value->{$colname});
                        }

                        $colname = 'niit_s';
                        if (is_numeric($value->{$colname})) {
                            $barilga->niit_talbai = doubleval($value->{$colname});
                        }

                        $colname = 'ashigtai_s';
                        if (is_numeric($value->{$colname})) {
                            $barilga->ashigtai_talbai = doubleval($value->{$colname});
                        }

                        $colname = 'suuts_s';
                        if (is_numeric($value->{$colname})) {
                            $barilga->barilgajih_talbai = doubleval($value->{$colname});
                        }

                        $colname = 'uilchilgee_s';
                        if (is_numeric($value->{$colname})) {
                            $doubleVal = doubleval($value->{$colname});
                            if ($doubleVal > 0) {
                                $barilga->zoriulalt_ids =
                                Togtmol::ORON_SUUTS.','.Togtmol::UILCHILGEE;
                            }

                            $barilga->uilchilgee_talbai = $doubleVal;
                        }

                        $colname = 'umch_helber';
                        if ($value->{$colname}) {
                            $barilga->umch_helber_id
                            = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::UMCH_HELBER, $cellName, $colname, $summary);
                        }

                        $colname = 'dulaanz_too';
                        if ($value->{$colname}) {
                            $barilga->dulaanz_too = intval($value->{$colname});
                        }

                        $colname = 'gadnaz_too';
                        if ($value->{$colname}) {
                            $barilga->gadnaz_too = intval($value->{$colname});
                        }

                        $colname = 'zahialagch';
                        if ($value->{$colname}) {
                            if (str_contains($value->{$colname}, 'ХК')
                                || str_contains($value->{$colname}, 'хк')) {
                                $barilga->zahialagch_comp_id = $this->getCompany($value->{$colname}, $cellName, $colname, $summary);
                            }
                            else {
                                $barilga->zahialagch_ner = $value->{$colname};
                            }
                        }

                        $colname = 'zurag_comp';
                        if ($value->{$colname}) {
                            $barilga->zurag_comp_ids = [$this->getCompany($value->{$colname}, $cellName, $colname, $summary)];
                        }

                        $colname = 'guits_comp';
                        if ($value->{$colname}) {
                            $barilga->guits_comps_ids = [$this->getCompany($value->{$colname}, $cellName, $colname, $summary)];
                        }

                        $colname = 'delgerengui';
                        if ($value->{$colname}) {
                            $barilga->delgerengui = $value->{$colname};
                        }

                        $barilgas[] = $barilga;
                    }

                    if (!$summary->hasIssues()) {
                        foreach ($barilgas as $saveBarilga) {
                            $saveBarilga->save();

                            if ($saveBarilga->uneTmp) {

                                $old = Une::where('barilga_id', $saveBarilga->id)
                                    ->where('addDate', $saveBarilga->uneTmp->addDate)->first();
                                if (!$old) {
                                    $saveBarilga->uneTmp->barilga_id = $saveBarilga->id;
                                    $saveBarilga->uneTmp->save();
                                }
                            }


                            $summary->incSuccess();
                        }

                        info('saved barilgas');
                    }
                });
            } else {
                $summary->addStructureIssue('Загвар файлаас өөр файл байна',
                    '');
            }

            return json_encode($summary);
        }
    }

//    public function importOS(Request $request)
//    {
//        if ($request->hasFile('file')) {
//            $path = $request->file('file')->getRealPath();
//
//            $summary = new Summary($request->file('file')->getClientOriginalName());
//
//            $data = Excel::load($path, function ($reader) {
//                $reader->skipRows(5);
//            })->get();
//
//            if (!empty($data) && $data->count()) {
//                try {
//                    $tmp = ($data[0]->id);
//                } catch (\Exception $e) {
//                    $summary->addStructureIssue('Файл нь 1 л хуудастай /sheet/ байх ёстой',
//                        '');
//
//                    return json_encode($summary);
//                }
//
//                \DB::transaction(function () use ($request, $data, $summary) {
//                    $barilgas = [];
//
//                    foreach ($data as $key => $value) {
//                        $cellName = 'Мөр:'.($key + 7).', Багана:';
//
//                        /*initial*/
//                        $barilga = null;
//                        $isNew = false;
//
//                        if ($value->id) {
//                            try {
//                                $barilga = Barilga::findOrFail($value->id);
//
//                                $barilga->detailTmp = $barilga->detail;
//                            } catch (\Exception $e) {
//                                $summary->addStructureIssue('Ийм ID-тай барилга байхгүй байна',
//                                    $cellName.'id {'.$value->id.'}');
//
//                                return json_encode($summary);
//                            }
//                        } else {
//                            $barilga = new Barilga();
//
//                            $barilga->is_imported = true;
//                            $isNew = true;
//                        }
//                        if (!$barilga->detailTmp) {
//                            $barilga->detailTmp = new BarilgaDetail();
//                        }
//
//                        $colname = 'kontor';
//                        if ($value->{$colname}) {
//                            $barilga->kontor = $value->{$colname};
//                        }
//
//                        $barilga->zoriulalt_ids = Togtmol::ORON_SUUTS;
////                                $this->checkMultiTogtmol($value->zoriulalts, 'zoriulalts',
//                        //                                    TogtmolTurul::BARILGA_ZORIULALT, $cellName, $summary);
//
////                        } elseif ($isNew)
//                        //                            $this->emptyRequired('zoriulalts', $cellName, $summary);
//
//                        if ($value->ner) {
//                            if ($value->ner == '-' ||
//                                $value->ner == ' ' ||
//                                $value->ner == '0') {
//                                $this->emptyRequired('ner', $cellName, $summary);
//                            } else {
//                                $barilga->ner = $value->ner;
//                            }
//                        } elseif ($isNew) {
//                            $this->emptyRequired('ner', $cellName, $summary);
//                        }
//
//                        if ($value->english) {
//                            $barilga->ner_eng = $value->english;
//                        }
//
//                        $colname = 'aimag';
//                        if ($value->{$colname}) {
//                            $aimag = Aimag::whereNer(str_replace(' аймаг', '', $value->{$colname}))->first(['id']);
//                            if ($aimag) {
//                                $barilga->aimag_id = $aimag->id;
//                            } else {
//                                $summary->addStructureIssue('Ийм нэртэй аймаг, нийслэл байхгүй байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname.'', $cellName, $summary);
//                        }
//
//                        $colname = 'sum_duureg';
//                        if ($value->{$colname}) {
//                            $sum_duureg = SumDuureg::whereAimagId($barilga->aimag_id)
//                                ->where('ner', str_replace(' сум', '', $value->{$colname}))->first(['id']);
//                            if ($sum_duureg) {
//                                $barilga->sum_duureg_id = $sum_duureg->id;
//                            } else {
//                                $summary->addStructureIssue('Ийм нэртэй сум, дүүрэг байхгүй байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'bag_horoo';
//                        if ($value->{$colname}) {
//                            $bag_horoo = BagHoroo::whereSumDuuregId($barilga->sum_duureg_id)
//                                ->where(function ($query) use ($value, $colname) {
//                                    $query->where('ner', $value->{$colname}.'-р хороо')
//                                        ->orWhere('ner', $value->{$colname}.'-р баг')
//                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'\'')
//                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'  баг\'')
//                                        ->orWhere('ner', $value->{$colname});
//                                })->first(['id']);
//
//                            if ($bag_horoo) {
//                                $barilga->bag_horoo_id = $bag_horoo->id;
//                            } else {
//                                $summary->addStructureIssue('Ийм нэртэй баг, хороо байхгүй байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'horoolol';
//                        if ($value->{$colname}) {
//                            $horoolol = Horoolol::whereSumDuuregId($barilga->sum_duureg_id)
//                                ->where('ner', $value->{$colname})->first(['id', 'bus_id']);
//                            if ($horoolol) {
//                                $barilga->bus_id = $horoolol->bus_id;
//                                $barilga->horoolol_id = $horoolol->id;
//                            } else {
//                                $summary->addStructureIssue('Ийм нэртэй хороолол байхгүй байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        } elseif ($isNew && $barilga->aimag_id == 22) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        if ($barilga->aimag_id != 22) {
//                            $barilga->bus_id = Togtmol::ORON_NUTAG;
//                        }
//
//                        $colname = 'hothon';
//                        if ($value->{$colname}) {
//                            $hothon = Hothon::whereSumDuuregId($barilga->sum_duureg_id)
//                                ->where('ner', $value->{$colname})->first(['id']);
//                            if ($hothon) {
//                                $barilga->hothon_id = $hothon->id;
//                            } else {
//                                $summary->addStructureIssue('Ийм нэртэй хотхон байхгүй байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        } elseif ($isNew && $barilga->aimag_id == 22) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        //davhardal baigaa esehiig shalgana. umnu iim bair baival aldaa butsaana
//                        if ($isNew && $this->getBarilgaFromAddress($barilga->ner, $barilga->aimag_id,
//                                $barilga->sum_duureg_id, $barilga->bag_horoo_id,
//                                $barilga->horoolol_id, $barilga->hothon_id)) {
//                            $summary->addStructureIssue('Ийм нэр, дугаар, хаяг бүхий барилга аль хэдийн бүртгэгдсэн байна',
//                                $cellName);
//
//                            return json_encode($summary);
//                        }
//                        $colname = 'gudamj';
//                        if ($value->{$colname}) {
//                            $barilga->gudamj = $value->{$colname};
//                        }
//
//                        $colname = 'address';
//                        if ($value->{$colname}) {
//                            $barilga->bairshil = $value->{$colname};
//                        }
//
//                        $colname = 'zipcode';
//                        if ($value->{$colname}) {
//                            $zipcode = $value->{$colname};
//
//                            if (strlen($zipcode) == 5) {
//                                $barilga->zipcode = $zipcode;
//                            } else {
//                                $summary->addStructureIssue('zipcode буруу байна',
//                                    $cellName);
//                            }
//                        }
//
//                        $colname = 'latlong';
//                        if ($value->{$colname}) {
//                            $arrays = explode(', ', $value->{$colname});
//                            if (count($arrays) != 2) {
//                                $arrays = explode(',', $value->{$colname});
//                            }
//                            if (count($arrays) != 2) {
//                                $arrays = explode(' ', $value->{$colname});
//                            }
//                            if (count($arrays) != 2) {
//                                $arrays = explode('  ', $value->{$colname});
//                            }
//                            if (count($arrays) != 2) {
//                                $arrays = explode('   ', $value->{$colname});
//                            }
//                            if (count($arrays) != 2) {
//                                $arrays = explode('/', $value->{$colname});
//                            }
//                            if (count($arrays) != 2) {
//                                $arrays = explode(' / ', $value->{$colname});
//                            }
//
//                            if (count($arrays) == 2 && $this->isValidLatLong($arrays[0], $arrays[1])) {
//                                $barilga->latitude = $arrays[0];
//                                $barilga->longtitude = $arrays[1];
//                            } else {
//                                $summary->addStructureIssue('Уртраг, өргөрөг буруу байна',
//                                    $cellName.$colname.' {'.$value->{$colname}.'}');
//                            }
//                        }
//
//                        $colname = 'tuluv';
//                        if ($value->{$colname}) {
//                            $barilga->is_active = $this->getBooleanVal($value->{$colname}, $cellName, $colname, $summary);
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'ashiglagdaagui_tuluv';
//                        if ($value->{$colname}) {
//                            $barilga->ashiglaagui_tuluv_id = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::ASHILAGDAAGUI_TULUV, $cellName, $colname, $summary);
//                        } elseif ($isNew && !$barilga->is_active) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        if ($value->yavts_huvi ||
//                            $value->yavts_tailbar ||
//                            $value->aoroh_ognoo ||
//                            $value->ehelsen_ognoo ||
//                            $value->zah_duussan_ognoo) {
//                            $barilga->shineBarilgaTmp = $barilga->shineBarilga;
//
//                            if (!$barilga->shineBarilgaTmp) {
//                                $barilga->shineBarilgaTmp = new ShineBarilga();
//                            }
//                        }
//
//                        $colname = 'yavts_huvi';
//                        if ($value->{$colname}) {
//                            $barilga->shineBarilgaTmp->yavts_huvi = intval($value->{$colname});
//                        }
//
//                        $colname = 'yavts_tailbar';
//                        if ($value->{$colname}) {
//                            $barilga->shineBarilgaTmp->yavts_tailbar = $value->{$colname};
//                        }
//
//                        $colname = 'aorson_ognoo';
//                        if ($value->{$colname}) {
//                            $barilga->aorson_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
//                        } elseif ($barilga->is_active) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'aoroh_ognoo';
//                        if ($value->{$colname}) {
//                            $barilga->shineBarilgaTmp->aoroh_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
//                            $barilga->aoroh_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'ehelsen_ognoo';
//                        if ($value->{$colname}) {
//                            $barilga->shineBarilgaTmp->ehelsen_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'zah_duussan_ognoo';
//                        if ($value->{$colname}) {
//                            $barilga->shineBarilgaTmp->zah_duussan_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
//                        }
//                        $colname = 'hiits';
//                        if ($value->{$colname}) {
//                            $barilga->hiits_id = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::BARILGA_HIITS, $cellName, $colname, $summary);
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'davhar';
//                        if ($value->{$colname}) {
//                            $barilga->davhar_too = intval($value->{$colname});
//                        } elseif ($isNew) {
//                            $this->emptyRequired($colname, $cellName, $summary);
//                        }
//
//                        $colname = 'ho_uls';
//                        if ($value->{$colname}) {
//                            $barilga->ho_uls_id = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::ULS_NER, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'os_turul';
//                        if ($value->{$colname}) {
//                            $barilga->os_turul_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::OS_TURUL, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'ail_too';
//                        if ($value->{$colname}) {
//                            $barilga->ail_too = intval($value->{$colname});
//                        }
//
//                        $colname = 'borlogdson_too';
//                        if ($value->{$colname}) {
//                            $barilga->borlogdson_too = intval($value->{$colname});
//                        }
//
//                        $colname = 'uruu_1';
//                        if ($value->{$colname}) {
//                            $barilga->uruu_1 = intval($value->{$colname});
//                        }
//
//                        $colname = 'uruu_2';
//                        if ($value->{$colname}) {
//                            $barilga->uruu_2 = intval($value->{$colname});
//                        }
//
//                        $colname = 'uruu_3';
//                        if ($value->{$colname}) {
//                            $barilga->uruu_3 = intval($value->{$colname});
//                        }
//
//                        $colname = 'uruu_4';
//                        if ($value->{$colname}) {
//                            $barilga->uruu_4 = intval($value->{$colname});
//                        }
//
//                        $colname = 'uruu_5';
//                        if ($value->{$colname}) {
//                            $barilga->uruu_5 = intval($value->{$colname});
//                        }
//
//                        $colname = 'duplex';
//                        if ($value->{$colname}) {
//                            $barilga->duplex = intval($value->{$colname});
//                        }
//
//                        $colname = 'penthouse';
//                        if ($value->{$colname}) {
//                            $barilga->pent_house = intval($value->{$colname});
//                        }
//
//                        $colname = 'niit_s';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->niit_talbai = doubleval($value->{$colname});
//                        }
//
//                        $colname = 'ashigtai_s';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->ashigtai_talbai = doubleval($value->{$colname});
//                        }
//
//                        $colname = 'suuts_s';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->barilgajih_talbai = doubleval($value->{$colname});
//                        }
//
//                        $colname = 'nogoon_s';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->nogoon_talbai = doubleval($value->{$colname});
//                        }
//
//                        $colname = 'uilchilgee_s';
//                        if ($value->{$colname}) {
//                            $doubleVal = doubleval($value->{$colname});
//                            if ($doubleVal > 0) {
//                                $barilga->zoriulalt_ids =
//                                    Togtmol::ORON_SUUTS.','.Togtmol::UILCHILGEE;
//                            }
//
//                            $barilga->detailTmp->uilchilgee_talbai = $doubleVal;
//                        }
//
//                        $colname = 'ashiglalt_baidal';
//                        if ($value->{$colname}) {
//                            $barilga->ashiglalt_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::ASHIGLALT_BAIDAL, $cellName, $colname, $summary);
//                        }
//                        $colname = 'umch_helber';
//                        if ($value->{$colname}) {
//                            $barilga->umch_helber_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::UMCH_HELBER, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'dulaanz_too';
//                        if ($value->{$colname}) {
//                            $barilga->dulaanz_too = intval($value->{$colname});
//                        }
//
//                        $colname = 'gadnaz_too';
//                        if ($value->{$colname}) {
//                            $barilga->gadnaz_too = intval($value->{$colname});
//                        }
//
//                        $colname = 'halaalt';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->halaalt_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::DED_BUTETS, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'tsahilgaan';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->tsahilgaan_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::DED_BUTETS, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'us';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->tsever_us_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::DED_BUTETS, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'holboo';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->holboo_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::DED_BUTETS, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'ariutgah';
//                        if ($value->{$colname}) {
//                            $barilga->detailTmp->ariutgah_id
//                                = $this->getSingleTogtmol($value->{$colname},
//                                TogtmolTurul::DED_BUTETS, $cellName, $colname, $summary);
//                        }
//
//                        $colname = 'zahialagch';
//                        if ($value->{$colname}) {
//                            if (str_contains($value->{$colname}, 'ХК') ||
//                                str_contains($value->{$colname}, 'хк')) {
//                                $barilga->zahialagch_comp_id = $this->getCompany($value->{$colname}, $cellName, $colname, $summary);
//                            } else {
//                                $barilga->zahialagch_ner = $value->{$colname};
//                            }
//                        }
//
//                        $colname = 'zurag_comp';
//                        if ($value->{$colname}) {
//                            $barilga->zurag_comp_ids = [$this->getCompany($value->{$colname}, $cellName, $colname, $summary)];
//                        }
//
//                        $colname = 'guits_comp';
//                        if ($value->{$colname}) {
//                            $barilga->guits_comps_ids = [$this->getCompany($value->{$colname}, $cellName, $colname, $summary)];
//                        }
//
//                        $colname = 'nemelt_medeelel';
//                        if ($value->{$colname}) {
//                            $barilga->delgerengui = $value->{$colname};
//                        }
//
//                        $barilgas[] = $barilga;
//                    }
//
//                    if (!$summary->hasIssues()) {
//                        foreach ($barilgas as $saveBarilga) {
//                            $saveBarilga->save();
//
//                            $saveBarilga->detailTmp->barilga_id = $saveBarilga->id;
//                            $saveBarilga->detailTmp->save();
//
//                            if ($saveBarilga->shineBarilgaTmp) {
//                                $saveBarilga->shineBarilgaTmp->barilga_id = $saveBarilga->id;
//                                $saveBarilga->shineBarilgaTmp->save();
//                            }
//
//                            $summary->incSuccess();
//                        }
//
//                        info('saved barilgas');
//                    }
//                });
//            } else {
//                $summary->addStructureIssue('Загвар файлаас өөр файл байна',
//                    '');
//            }
//
//            return json_encode($summary);
//        }
//    }

    public function importOSObject(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();

            $summary = new Summary($request->file('file')->getClientOriginalName());

            $data = Excel::load($path, function ($reader) {
                $reader->skipRows(5);
            })->get();

            if (!empty($data) && $data->count()) {
                try {
                    $tmp = ($data[0]->id);
                } catch (\Exception $e) {
                    $summary->addStructureIssue('Файл нь 1 л хуудастай /sheet/ байх ёстой',
                        '');

                    return json_encode($summary);
                }

                \DB::transaction(function () use ($request, $data, $summary) {
                    $barilgaObjects = [];

                    foreach ($data as $key => $value) {
                        $cellName = 'Мөр:'.($key + 7).', Багана:';

                        /*initial*/
                        $barilga = null;
                        $barilgaObject = new BarilgaObject();
                        $barilgaObject->is_imported = true;
                        $isNew = false;

                        if ($value->id) {
                            try {
                                $barilga = Barilga::findOrFail($value->id);

                                $barilgaObject->barilga_id = $barilga->id;
                            } catch (\Exception $e) {
                                $summary->addStructureIssue('Ийм ID-тай барилга байхгүй байна',
                                    $cellName.'id {'.$value->id.'}');

                                return json_encode($summary);
                            }
                        } else {
                            $barilga = new Barilga();

                            $isNew = true;
                        }

                        if ($value->ner) {
                            if ($value->ner == '-' ||
                                $value->ner == ' ' ||
                                $value->ner == '0') {
                                $this->emptyRequired('ner', $cellName, $summary);
                            } else {
                                $barilga->ner = $value->ner;
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired('ner', $cellName, $summary);
                        }

                        $colname = 'aimag';
                        if ($value->{$colname}) {
                            $aimag = Aimag::whereNer(str_replace(' аймаг', '', $value->{$colname}))->first(['id']);
                            if ($aimag) {
                                $barilga->aimag_id = $aimag->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй аймаг, нийслэл байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname.'', $cellName, $summary);
                        }

                        $colname = 'sum_duureg';
                        if ($value->{$colname}) {
                            $sum_duureg = SumDuureg::whereAimagId($barilga->aimag_id)
                                ->where('ner', str_replace(' сум', '', $value->{$colname}))->first(['id']);
                            if ($sum_duureg) {
                                $barilga->sum_duureg_id = $sum_duureg->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй сум, дүүрэг байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'bag_horoo';
                        if ($value->{$colname}) {
                            $bag_horoo = BagHoroo::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where(function ($query) use ($value, $colname) {
                                    $query->where('ner', $value->{$colname}.'-р хороо')
                                        ->orWhere('ner', $value->{$colname}.'-р баг')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'\'')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.' баг\'')
                                        ->orWhere('ner', $value->{$colname});
                                })->first(['id']);

                            if ($bag_horoo) {
                                $barilga->bag_horoo_id = $bag_horoo->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй баг, хороо байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'horoolol';
                        if ($value->{$colname}) {
                            $horoolol = Horoolol::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id', 'bus_id']);
                            if ($horoolol) {
                                $barilga->bus_id = $horoolol->bus_id;
                                $barilga->horoolol_id = $horoolol->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хороолол байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew && $barilga->aimag_id == 22) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'hothon';
                        if ($value->{$colname}) {
                            $hothon = Hothon::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id']);
                            if ($hothon) {
                                $barilga->hothon_id = $hothon->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хотхон байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew && $barilga->aimag_id == 22) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        if ($isNew) {
                            $barilga = $this->getBarilgaFromAddress($barilga->ner, $barilga->aimag_id,
                                $barilga->sum_duureg_id, $barilga->bag_horoo_id,
                                $barilga->horoolol_id, $barilga->hothon_id);

                            if (!$barilga) {
                                $summary->addStructureIssue('Ийм нэр, дугаар, хаяг бүхий барилга олдсонгүй',
                                    $cellName);

                                return json_encode($summary);
                            } else {
                                $barilgaObject->barilga_id = $barilga->id;
                            }
                        }

                        $barilgaObject->zoriulalt_id = Togtmol::ORON_SUUTS;

                        $colname = 'uruu_songolt';
                        if ($value->{$colname}) {
                            $barilgaObject->uruu_too = intval($value->{$colname});
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'talbai';
                        if ($value->{$colname}) {
                            $barilgaObject->talbai = doubleval($value->{$colname});
                        }

                        $colname = 'suuts_too';
                        if ($value->{$colname}) {
                            $barilgaObject->too = intval($value->{$colname});
                        }

                        //davhardal baigaa esehiig shalgana. umnu iim bair baival aldaa butsaana
                        if ($this->getBarilgaObjectFromBarilga($barilga->id, $barilgaObject->uruu_too,
                            $barilgaObject->talbai)) {
                            $summary->addStructureIssue('Тухайн барилгад ийм өрөөний сонголт, талбай аль хэдийн бүртгэгдсэн байна',
                                $cellName);

                            return json_encode($summary);
                        }

                        $colname = 'uldegdel_too';
                        if ($value->{$colname}) {
                            $barilgaObject->uldegdel = intval($value->{$colname});
                        }



                        $barilgaObjects[] = $barilgaObject;
                    }

                    if (!$summary->hasIssues()) {
                        foreach ($barilgaObjects as $saveBarilgaObject) {
                            $saveBarilgaObject->save();

                            $summary->incSuccess();
                        }
                    }

                    // (new Importer($request->allFiles(), 'barilgaObject'))->run($summary);

                    info('saved barilgaObjects');
                });
            } else {
                $summary->addStructureIssue('Загвар файлаас өөр файл байна',
                    '');
            }

            return json_encode($summary);
        }
    }

    public function importOSReport(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();

            $summary = new Summary($request->file('file')->getClientOriginalName());

            $data = Excel::load($path, function ($reader) {
                $reader->skipRows(4);
            })->get();

            if (!empty($data) && $data->count()) {
                try {
                    $tmp = ($data[0]->id);
                } catch (\Exception $e) {
                    $summary->addStructureIssue('Файл нь 1 л хуудастай /sheet/ байх ёстой',
                        '');

                    return json_encode($summary);
                }

                DB::transaction(function () use ($request, $data, $summary) {
                    $barilgas = [];

                    foreach ($data as $key => $value) {
                        $cellName = 'Мөр:'.($key + 6).', Багана:';

                        /*initial*/
                        $barilga = new Barilga();
                        $barilgaObject = new BarilgaObject();
                        $barilgaObject->is_imported = true;
                        $isNew = false;

                        if ($value->id) {
                            try {
                                $barilga = Barilga::findOrFail($value->id);
                            } catch (\Exception $e) {
                                $summary->addStructureIssue('Ийм ID-тай барилга байхгүй байна',
                                    $cellName.'id {'.$value->id.'}');

                                return json_encode($summary);
                            }
                        } else {
                            $barilga = new Barilga();
                            $isNew = true;
                        }

                        $colname = 'aimag';
                        if ($value->{$colname}) {
                            $aimag = Aimag::whereNer(str_replace(' аймаг', '', $value->{$colname}))->first(['id']);
                            if ($aimag) {
                                $barilga->aimag_id = $aimag->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй аймаг, нийслэл байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname.'', $cellName, $summary);
                        }

                        $colname = 'sum_duureg';
                        if ($value->{$colname}) {
                            $sum_duureg = SumDuureg::whereAimagId($barilga->aimag_id)
                                ->where('ner', str_replace(' сум', '', $value->{$colname}))->first(['id']);
                            if ($sum_duureg) {
                                $barilga->sum_duureg_id = $sum_duureg->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй сум, дүүрэг байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'bag_horoo';
                        if ($value->{$colname}) {
                            $bag_horoo = BagHoroo::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where(function ($query) use ($value, $colname) {
                                    $query->where('ner', $value->{$colname}.'-р хороо')
                                        ->orWhere('ner', $value->{$colname}.'-р баг')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.'\'')
                                        ->orWhereRaw('SUBSTRING_INDEX(ner,\', \',-1)=\''.$value->{$colname}.' баг\'')
                                        ->orWhere('ner', $value->{$colname});
                                })->first(['id']);

                            if ($bag_horoo) {
                                $barilga->bag_horoo_id = $bag_horoo->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй баг, хороо байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'horoolol';
                        if ($value->{$colname}) {
                            $horoolol = Horoolol::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id', 'bus_id']);
                            if ($horoolol) {
                                $barilga->bus_id = $horoolol->bus_id;
                                $barilga->horoolol_id = $horoolol->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хороолол байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew && $barilga->aimag_id == 22) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'hothon';
                        if ($value->{$colname}) {
                            $hothon = Hothon::whereSumDuuregId($barilga->sum_duureg_id)
                                ->where('ner', $value->{$colname})->first(['id']);
                            if ($hothon) {
                                $barilga->hothon_id = $hothon->id;
                            } else {
                                $summary->addStructureIssue('Ийм нэртэй хотхон байхгүй байна',
                                    $cellName.$colname.' {'.$value->{$colname}.'}');
                            }
                        } elseif ($isNew && $barilga->aimag_id == 22) {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }
                        $colname = 'ner';
                        if ($value->{$colname}) {
                            $barilga->ner = $value->{$colname};
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $barilga = $this->getBarilgaFromAddress($barilga->ner, $barilga->aimag_id,
                            $barilga->sum_duureg_id, $barilga->bag_horoo_id,
                            $barilga->horoolol_id, $barilga->hothon_id);

                        if (!$barilga) {
                            $summary->addStructureIssue('Ийм нэр, дугаар, хаяг бүхий барилга олдсонгүй',
                                $cellName);

                            return json_encode($summary);
                        } else {
                            $barilgaObject->barilga_id = $barilga->id;
                        }

                        $shineBarilga = $barilga->shineBarilga;

                        if (!$shineBarilga) {
                            $shineBarilga = new ShineBarilga();
                            $shineBarilga->barilga_id = $barilga->id;
                        }

                        $colname = 'ail_too';
                        if ($value->{$colname}) {
                            $barilga->ail_too = intval($value->{$colname});
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'uldegdel_ail';
                        if ($value->{$colname}) {
                            $barilga->uldegdel = intval($value->{$colname});
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'niit_1_uldegdel';
                        if ($value->{$colname}) {
                            $barilga->uruu_1_uld = intval($value->{$colname});
                        } else {
                            $barilga->uruu_1_uld = 0;
                        }

                        $colname = 'niit_2_uldegdel';
                        if ($value->{$colname}) {
                            $barilga->uruu_2_uld = intval($value->{$colname});
                        } else {
                            $barilga->uruu_2_uld = 0;
                        }

                        $colname = 'niit_3_uldegdel';
                        if ($value->{$colname}) {
                            $barilga->uruu_3_uld = intval($value->{$colname});
                        } else {
                            $barilga->uruu_3_uld = 0;
                        }

                        $colname = 'niit_4_uldegdel';
                        if ($value->{$colname}) {
                            $barilga->uruu_4_uld = intval($value->{$colname});
                        } else {
                            $barilga->uruu_4_uld = 0;
                        }

                        $colname = 'niit_5_uldegdel';
                        if ($value->{$colname}) {
                            $barilga->uruu_5_uld = intval($value->{$colname});
                        } else {
                            $barilga->uruu_5_uld = 0;
                        }

                        $colname = 'niit_1';
                        if ($value->{$colname}) {
                            $barilga->uruu_1 = intval($value->{$colname});
                        } else {
                            $barilga->uruu_1 = 0;
                        }

                        $colname = 'niit_2';
                        if ($value->{$colname}) {
                            $barilga->uruu_2 = intval($value->{$colname});
                        } else {
                            $barilga->uruu_2 = 0;
                        }

                        $colname = 'niit_3';
                        if ($value->{$colname}) {
                            $barilga->uruu_3 = intval($value->{$colname});
                        } else {
                            $barilga->uruu_3 = 0;
                        }

                        $colname = 'niit_4';
                        if ($value->{$colname}) {
                            $barilga->uruu_4 = intval($value->{$colname});
                        } else {
                            $barilga->uruu_4 = 0;
                        }

                        $colname = 'niit_5';
                        if ($value->{$colname}) {
                            $barilga->uruu_5 = intval($value->{$colname});
                        } else {
                            $barilga->uruu_5 = 0;
                        }

                        $colname = 'report_date';
                        if ($value->{$colname}) {
                            $addDate = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
                            $barilga->uneTmp = Une::where('barilga_id', $barilga->id)->where('AddDate', $addDate)
                                ->first();
                            if (!$barilga->uneTmp) {
                                $barilga->uneTmp = new Une();
                                $barilga->uneTmp->CurrencyID = 1;
                                $barilga->uneTmp->AddDate = $addDate;
                            }
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'unitprice';
                        if ($value->{$colname}) {
                            $barilga->uneTmp->UnitPrice = doubleval($value->{$colname});
                        }

                        $colname = 'realprice';
                        if ($value->{$colname}) {
                            $barilga->uneTmp->RealPrice = doubleval($value->{$colname});
                        }

                        $colname = 'webprice';
                        if ($value->{$colname}) {
                            $barilga->uneTmp->WebPrice = doubleval($value->{$colname});
                        }

                        //shine barilga
                        $colname = 'barilga_yavts';
                        if ($value->{$colname}) {
                            $barilga->shineBarilgaTmp = ShineBarilga::where('barilga_id', $barilga->id)->first();
                            if (!$barilga->shineBarilgaTmp) {
                                $barilga->shineBarilgaTmp = new ShineBarilga();
                            }
                            $barilga->shineBarilgaTmp->yavts_huvi = intval($value->{$colname});
                        } else {
                            $this->emptyRequired($colname, $cellName, $summary);
                        }

                        $colname = 'borluulalt_huvi';
                        if ($value->{$colname}) {
                            $barilga->shineBarilgaTmp->borluulalt_huvi = intval($value->{$colname});
                        }

                        $colname = 'ehelsen_ognoo';
                        if ($value->{$colname}) {
                            $barilga->shineBarilgaTmp->ehelsen_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
                        }
                        $colname = 'aoroh_ognoo';
                        if ($value->{$colname}) {
                            $barilga->shineBarilgaTmp->aoroh_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
                            $barilga->aoroh_ognoo = $this->getDateVal($value->{$colname}, $cellName, $colname, $summary);
                        }

                        $colname = 'garageprice';
                        if ($value->{$colname}) {
                            $barilga->uneTmp->GaragePrice = doubleval($value->{$colname});
                        }

                        $colname = 'status';
                        if ($value->{$colname}) {
                            $barilga->shineBarilgaTmp->status_id = $this->getSingleTogtmol($value->{$colname},
                                TogtmolTurul::SHINE_BARILGA_STATUS, $cellName, $colname, $summary);
                        }
                        $s40 = $this->getSingleTogtmol('40 мкв хүртэл',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s41_60 = $this->getSingleTogtmol('41-60 мкв',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s61_80 = $this->getSingleTogtmol('61-80 мкв',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s81_100 = $this->getSingleTogtmol('81-100 мкв',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s101_120 = $this->getSingleTogtmol('101-120 мкв',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s121_150 = $this->getSingleTogtmol('121-150 мкв',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $s151 = $this->getSingleTogtmol('151 мкв-с дээш',
                            TogtmolTurul::TALBAI_INTERVAL, $cellName, $colname, $summary);
                        $barilgas[] = $barilga;
                        $barilga->objectsTmp = [];

                        $colname = 'u1_40';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 1)->where('talbai_id', $s40)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 1;
                                $barObj->talbai_id = $s40;
                            }
                            $barObj->too = intval($value->u1_40);
                            $barObj->uldegdel = intval($value->u1_40_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u1_41_60';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 1)->where('talbai_id', $s41_60)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 1;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u1_41_60);
                            $barObj->uldegdel = intval($value->u1_41_60_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }

                        //2 URUU
                        $colname = 'u2_40';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 2)->where('talbai_id', $s40)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 2;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u2_40);
                            $barObj->uldegdel = intval($value->u2_40_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u2_41_60';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 2)->where('talbai_id', $s41_60)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 2;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u2_41_60);
                            $barObj->uldegdel = intval($value->u2_41_60_uldegdel);
                            $barilga->objectsTmp = [];
                        }
                        $colname = 'u2_61_80';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 2)->where('talbai_id', $s61_80)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 2;
                                $barObj->talbai_id = $s61_80;
                            }
                            $barObj->too = intval($value->u2_61_80);
                            $barObj->uldegdel = intval($value->u2_61_80_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u2_81_100';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 2)->where('talbai_id', $s81_100)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 2;
                                $barObj->talbai_id = $s81_100;
                            }
                            $barObj->too = intval($value->u2_81_100);
                            $barObj->uldegdel = intval($value->u2_81_100_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u2_101_120';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 2)->where('talbai_id', $s101_120)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 1;
                                $barObj->talbai_id = $s101_120;
                            }
                            $barObj->too = intval($value->u2_101_120);
                            $barObj->uldegdel = intval($value->u2_101_120_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }

                        //3 uruu

                        $colname = 'u3_41_60';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s41_60)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u3_41_60);
                            $barObj->uldegdel = intval($value->u3_41_60_uldegdel);
                            $barilga->objectsTmp = [];
                        }
                        $colname = 'u3_61_80';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s61_80)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s61_80;
                            }
                            $barObj->too = intval($value->u3_61_80);
                            $barObj->uldegdel = intval($value->u3_61_80_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u3_81_100';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s81_100)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s81_100;
                            }
                            $barObj->too = intval($value->u3_81_100);
                            $barObj->uldegdel = intval($value->u3_81_100_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u3_101_120';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s101_120)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s101_120;
                            }
                            $barObj->too = intval($value->u3_101_120);
                            $barObj->uldegdel = intval($value->u3_101_120_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u3_121_150';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s121_150)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s121_150;
                            }
                            $barObj->too = intval($value->u3_121_150);
                            $barObj->uldegdel = intval($value->u3_121_150_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u3_151';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 3)->where('talbai_id', $s151)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 3;
                                $barObj->talbai_id = $s151;
                            }
                            $barObj->too = intval($value->u3_151);
                            $barObj->uldegdel = intval($value->u3_151_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        //4 uruu

                        $colname = 'u4_41_60';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s41_60)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u4_41_60);
                            $barObj->uldegdel = intval($value->u4_41_60_uldegdel);
                            $barilga->objectsTmp = [];
                        }
                        $colname = 'u4_61_80';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s61_80)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s61_80;
                            }
                            $barObj->too = intval($value->u4_61_80);
                            $barObj->uldegdel = intval($value->u4_61_80_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u4_81_100';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s81_100)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s81_100;
                            }
                            $barObj->too = intval($value->u4_81_100);
                            $barObj->uldegdel = intval($value->u4_81_100_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u4_101_120';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s101_120)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s101_120;
                            }
                            $barObj->too = intval($value->u4_101_120);
                            $barObj->uldegdel = intval($value->u4_101_120_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u4_121_150';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s121_150)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s121_150;
                            }
                            $barObj->too = intval($value->u4_121_150);
                            $barObj->uldegdel = intval($value->u4_121_150_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u4_151';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 4)->where('talbai_id', $s151)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 4;
                                $barObj->talbai_id = $s151;
                            }
                            $barObj->too = intval($value->u4_151);
                            $barObj->uldegdel = intval($value->u4_151_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        //3 uruu

                        $colname = 'u5_41_60';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s41_60)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s41_60;
                            }
                            $barObj->too = intval($value->u5_41_60);
                            $barObj->uldegdel = intval($value->u5_41_60_uldegdel);
                            $barilga->objectsTmp = [];
                        }
                        $colname = 'u5_61_80';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s61_80)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s61_80;
                            }
                            $barObj->too = intval($value->u5_61_80);
                            $barObj->uldegdel = intval($value->u5_61_80_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u5_81_100';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s81_100)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s81_100;
                            }
                            $barObj->too = intval($value->u5_81_100);
                            $barObj->uldegdel = intval($value->u5_81_100_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u5_101_120';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s101_120)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s101_120;
                            }
                            $barObj->too = intval($value->u5_101_120);
                            $barObj->uldegdel = intval($value->u5_101_120_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u5_121_150';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s121_150)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s121_150;
                            }
                            $barObj->too = intval($value->u5_121_150);
                            $barObj->uldegdel = intval($value->u5_121_150_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                        $colname = 'u5_151';
                        if ($value->{$colname}) {
                            $barObj = BarilgaObject::where('barilga_id', $barilga->id)
                                ->where('uruu_too', 5)->where('talbai_id', $s151)->first();
                            if (!$barObj) {
                                $barObj = new BarilgaObject();
                                $barObj->barilga_id = $barilga->id;
                                $barObj->uruu_too = 5;
                                $barObj->talbai_id = $s151;
                            }
                            $barObj->too = intval($value->u5_151);
                            $barObj->uldegdel = intval($value->u5_151_uldegdel);
                            $barilga->objectsTmp[] = $barObj;
                        }
                    }

                    if (!$summary->hasIssues()) {
                        foreach ($barilgas as $saveBarilga) {
                            $saveBarilga->save();

                            if ($saveBarilga->uneTmp->AddDate) {
                                $saveBarilga->uneTmp->barilga_id = $saveBarilga->id;
                                $saveBarilga->uneTmp->save();
                            }
                            if ($saveBarilga->shineBarilgaTmp->yavts_huvi) {
                                $saveBarilga->shineBarilgaTmp->barilga_id = $saveBarilga->id;
                                $saveBarilga->shineBarilgaTmp->save();
                            }
                            if ($saveBarilga->objectsTmp) {
                                foreach ($saveBarilga->objectsTmp as $obj) {
                                    $obj->save();
                                    info($obj);
                                }
                            }

                            $summary->incSuccess();
                        }
                    }
                    info('saved barilgas');
                });
            } else {
                $summary->addStructureIssue('Загвар файлаас өөр файл байна',
                    '');
            }

            return json_encode($summary);
        }
    }

    public function importCompany(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->getRealPath();

            $summary = new Summary($request->file('file')->getClientOriginalName());

            $data = Excel::load($path, function ($reader) {
                $reader->skipRows(1);
            })->get();

            if (!empty($data) && $data->count()) {
                try {
                    $tmp = ($data[0]->ner);
                } catch (\Exception $e) {
                    $summary->addStructureIssue('Файл нь 1 л хуудастай /sheet/ байх ёстой',
                        '');

                    return json_encode($summary);
                }

                \DB::transaction(function () use ($request, $data, $summary) {
                    $companies = [];

                    foreach ($data as $key => $value) {
                        $cellName = 'Мөр:'.($key + 3).', Багана:';

                        /*initial*/
                        $company = null;

                        if ($value->ner) {
                            $company = Company::where('ner', $value->ner)->first();
                            if (!$company) {
                                $company = new Company();
                                $company->ner = $value->ner;
                            }
                        } else {
                            $this->emptyRequired('ner', $cellName, $summary);
                        }

                        if ($value->zahiral_ner) {
                            $company->zahiral_ner = $value->zahiral_ner;
                        }

                        if ($value->zahiral_utas) {
                            $company->zahiral_utas = $value->zahiral_utas;
                        }

                        if ($value->borluulalt_utas) {
                            $company->borluulalt_utas = $value->borluulalt_utas;
                        }

                        if ($value->busad_utas) {
                            $company->busad_utas = $value->busad_utas;
                        }

                        $companies[] = $company;
                    }

                    if (!$summary->hasIssues()) {
                        foreach ($companies as $saveComp) {
                            $saveComp->save();

                            $summary->incSuccess();
                        }
                    }

                    info('saved company');
                });
            } else {
                $summary->addStructureIssue('Загвар файлаас өөр файл байна',
                    '');
            }

            return json_encode($summary);
        }
    }

    public function getBarilgaFromAddress($ner, $aimag_id, $sum_duureg_id, $bag_horoo_id, $horoolol_id, $hothon_id)
    {
        $query = Barilga::whereNer($ner);

        $query->where('aimag_id', $aimag_id)->where('sum_duureg_id', $sum_duureg_id)
            ->where('bag_horoo_id', $bag_horoo_id);
        if ($horoolol_id) {
            $query->where('horoolol_id', $horoolol_id);
        }
        if ($hothon_id) {
            $query->where('hothon_id', $hothon_id);
        }

        $barilga = $query->first();

        return $barilga;
    }

    public function getBarilgaObjectFromBarilga($barilga_id, $uruu_too, $talbai)
    {
        $query = BarilgaObject::whereBarilgaId($barilga_id)
            ->where('uruu_too', $uruu_too);

        if ($talbai) {
            $query->where('talbai', $talbai);
        }

        return $query->first();
    }

    public function getDateVal($value, $cellName, $colname, $summary)
    {
        if (is_a($value, 'DateTime')) {
            return $value;
        }

        try {
            $d = Carbon::createFromFormat('Y-m-d', $value);
            if ($d && $d->format('Y-m-d') == $value) {
                return $d;
            }
        } catch (\Exception $exception) {
            try {
                $d = Carbon::createFromFormat('Y-m-d', $value.'-07-01');
                if ($d && $d->format('Y-m-d') == $value.'-07-01') {
                    return $d;
                }
            } catch (\Exception $exception) {
            }
        }
        $summary->addStructureIssue('YYYY-MM-DD эсвэл YYYY форматтай өгөгдөл оруулна',
            $cellName.$colname.' {'.$value.'}');

        return null;
    }

    public function isValidLatLong($latitude, $longitude)
    {
        $match = (preg_match("/^(\+|-)?(?:90(?:(?:\.0{1,8})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,8})?))$/", $latitude)
            && (preg_match("/^(\+|-)?(?:180(?:(?:\.0{1,8})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,8})?))$/",
                $longitude))) ?
        true : false;

        return $match;
    }

    public function getBooleanVal($value, $cellName, $colname, $summary)
    {
        if (trim($value) == 'Тийм') {
            return true;
        } elseif (trim($value) == 'Үгүй') {
            return false;
        }

        $summary->addStructureIssue('Тийм эсвэл Үгүй гэсэн сонголт биш байна',
            $cellName.$colname.' {'.$value.'}');

        return null;
    }

    public function emptyRequired($name, $cellName, $summary)
    {
        $summary->addStructureIssue(EMPTY_REQUIRED_FIELD,
            $cellName.$name);
    }

    public function checkMultiTogtmol($value, $name, $turul, $cellName, $summary)
    {
        $arrays = explode(', ', $value);
        $ids = [];

        foreach ($arrays as $zoriulalt) {
            $togtmol = Togtmol::where('ner', $zoriulalt)
                ->where('undsen_id', $turul)->first();

            if ($togtmol) {
                $ids[] = $togtmol->id;
            } else {
                $summary->addStructureIssue(NOT_IN_DB,
                    $cellName.$name.' {'.$value.'}');
            }
        }

        return $ids;
    }

    public function getSingleTogtmol($value, $turul, $cellName, $colname, $summary)
    {
        //$togtmol = Togtmol::whereNer($value)
           $togtmol=DB::table('t_togtmol')->where('undsen_id', $turul)->where('ner',$value)->first();
        if ($togtmol) {
            return $togtmol->id;
        } else {
            $summary->addStructureIssue('Ийм сонголт байхгүй байна',
                $cellName.$colname.' {'.$value.'}');
        }
        return null;
    }

    public function getCompany($value, $cellName, $colname, $summary)
    {
        try {
            $company =DB::table('t_company')->where('ner',$value)->first();
            //Company::whereNer($value)->firstOrFail(['id']);

            return $company->id;
        } catch (\Exception $e) {
            $summary->addStructureIssue('Ийм сонголт байхгүй байна',
                $cellName.$colname.' {'.$value.'}');
        }

        return null;
    }
}
