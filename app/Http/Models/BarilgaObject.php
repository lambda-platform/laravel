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

class BarilgaObject extends Model
{
    use SoftDeletes;

    protected $table = 't_barilga_object';

    protected $fillable = ['zoriulalt_id', 'uruu_id', 'zoriulalt_ded_id'
        , 'talbai', 'too', 'borlogdson_too'];

    public $uneTmp = null;

    public function barilga()
    {
        return $this->belongsTo(Barilga::class);
    }


}
