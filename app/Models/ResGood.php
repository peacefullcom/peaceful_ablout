<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class ResGood extends Model
{

    protected $table = "res_goods";

    protected $fillable = array(
        'id',
        'res_id',
        'cate_id',
        'name',
        'name_en',
        'price',
        'img',
    );
}
