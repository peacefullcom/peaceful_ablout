<?php
/**
 * ClassName: MediaAuthor
 * 作者模型
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class MediaAuthor extends Model
{
    /**
     * 模型表article
     * @var string
     */
    protected $table = "media_author";

    protected $fillable = array(
        'name',
        'title',
        'description',
    );

    public function getMediaAuthorSelection() {
        $data = self::select(['id', 'name'])->get()->toArray();
        $res = [];
        foreach ($data as $author) {
            $res[$author['id']] = $author['name'];
        }
        return $res;
    }
    
}
