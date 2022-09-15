<?php
/**
 * ClassName: VotePlayer
 * 投票选手模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class VotePlayer extends Model
{
    /**
     * 模型表vote_player
     * @var string
     */
    protected $table = "vote_player";

    protected $fillable = array(
        'code',
        'vote_id',
        'group_id',
        'name',
        'content',
        'img',
        'is_active',
        'vote_count',
        'sort',
    );
}
