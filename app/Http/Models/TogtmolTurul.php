<?php
/**
 * Created by PhpStorm.
 * User: Shonkhor
 * Date: 07/07/2018
 * Time: 17:57.
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TogtmolTurul extends Model
{
    use SoftDeletes;

    const ZEREGLEL = 41;
    const HUD_UILCHILGEE_TURUL = 2;
    const BARILGA_ZORIULALT = 5;
    const YAMAR_COMPANY = 92;
    const COMP_UA_CHIGLEL = 91;
    const ASHILAGDAAGUI_TULUV = 93;
    const BARILGA_HIITS = 13;
    const BARILGA_ZEREGLEL = 41;
    const ULS_NER = 94;
    const ZAHIALGIIN_TULUV = 52;
    const BUSCHLEL = 75;
    const UMCH_HELBER = 95;
    const ASHIGLALT_BAIDAL = 96;
    const OS_TURUL = 97;
    const DED_BUTETS = 26;
    const URUU_TOO = 39;
    const AGAAR_BUS = 4;
    const URIDACH_TULUV = 56;
    const CURRENCY = 3;
    const SHINE_BARILGA_STATUS = 43;
    const TALBAI_INTERVAL = 9;
    const ZAHIALGA_TULUV = 98;

    protected $table = 't_togtmol_turul';
}
