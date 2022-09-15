<?php
/**
 * ClassName: VoteLog
 * 投票日志模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class VoteLog extends Model
{
    /**
     * 模型表vote_log
     * @var string
     */
    protected $table = "vote_log";

    protected $fillable = array(
        'vote_id',
        'player_id',
        'phone'
    );

    /**
     * 关联候选人模型
     * @access public
     * @return $this
     */
    public function player(){
        return $this->belongsTo(VotePlayer::class, 'player_id');
    }
}
