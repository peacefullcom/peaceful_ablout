<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ResCate extends Model
{

    protected $table = "res_cate";

    protected $fillable = array(
        'id',
        'res_id',
        'name',
        'name_en',
    );
}
