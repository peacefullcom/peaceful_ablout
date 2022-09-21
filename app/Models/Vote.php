<?php
/**
 * ClassName: Vote
 * 投票模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Vote extends Model
{
    /**
     * 模型表vote
     * @var string
     */
    protected $table = "vote";

    protected $fillable = array(
        'title',
        'content',
        'rule',
        'day_votes',
        'vote_count',
        'view_count',
        'player_count',
        'group',
        'is_delete',
        'start_at',
        'end_at'
    );

    public function getGroupOption() {
        $options = explode(',', $this->group);
        if (count($options) < 2) return '';
        $tmp = [];
        foreach ($options as $option) {
            $tmp = explode('=', $option);
            $res[$tmp[0]] = $tmp[1];
        }
        return $res;
    }
    
}
