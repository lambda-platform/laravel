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

class Company extends Model
{
    use SoftDeletes;
    protected $table = 't_company';
}
