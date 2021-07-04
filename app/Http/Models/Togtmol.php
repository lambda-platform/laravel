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

class Togtmol extends Model
{
    use SoftDeletes;

    const ZAHIALAGCH=394;
    const ZURAG_TUSUL=395;
    const GUITSETGEGCH=396;

    const ORON_SUUTS=4;
    const UILCHILGEE=6;
    const ORON_NUTAG=369;

    protected $table = 't_togtmol';

}
