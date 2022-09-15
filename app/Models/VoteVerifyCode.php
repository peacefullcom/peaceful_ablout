<?php
/**
 * ClassName: VoteVerifyCode
 * 投票验证码模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class VoteVerifyCode extends Model
{
    /**
     * 模型表vote_verify_code
     * @var string
     */
    protected $table = "vote_verify_code";

    protected $fillable = array(
        'phone',
        'code',
        'status',
        'expired_at',
        'verified_at'
    );
}
