<?php
/**
 * Created by PhpStorm.
 * User: Shonkhor
 * Date: 07/07/2018
 * Time: 17:57
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class ShineBarilga extends Model
{
    use SoftDeletes;

    protected $table = 't_shine_barilga';

    protected $fillable = ['ner', 'ner_eng', 'menejment_bag',
        'borluulalt_bag', 'niit_urtug', 'borluulalt_orlogo',
        'delgerengui', 'ashiglalt_id', 'aorson_ognoo', 'aoroh_ognoo',
        'niit_talbai', 'agaar_bus_id',
        'ashigtai_talbai', 'barilgajih_talbai', 'nogoon_talbai',
        'uilchilgee_talbai', 'zahialagch_ner',
        'dulaanz_too', 'gadnaz_too', 'gh_ball',
        'ho_uls_id', 'uridach_tuluv_id',
        'uruu_1', 'uruu_2', 'uruu_3', 'uruu_4', 'uruu_5', 'duplex',
        'lift_too', 'davhar_too', 'davhar_hemjee', 'davhar_ail_too',
        'is_active', 'is_imported', 'ashiglaagui_tuluv_id',
        'hiits_id', 'umch_helber_id', 'halaalt_id',
        'tsahilgaan_id', 'tsever_us_id', 'holboo_id', 'ariutgah_id',
        'os_turul_id', 'ail_too', 'borlogdson_too',
        'kontor', 'pent_house'];

    public $guitsCompsTmp = null;
    public $shineBarilgaTmp = null;


    public function shineBarilga()
    {
        return $this->hasOne(ShineBarilga::class);
    }


}
