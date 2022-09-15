<?php
/**
 * ClassName: VoteLogController
 * 投票日志控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;
use App\Models\Vote;
use App\Models\VotePlayer;
use App\Models\VoteLog;

class VoteLogController extends Controller
{  
    public function __construct()
    {  
         
    }

    /**
     * 投票日志列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request, $id)
    {
        $vote = Vote::find($id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This voting does not exist.');
        }
        $voteLogModel = new VoteLog();
        $query = $voteLogModel->query();
        $query->where('vote_id', '=', $id);
        $voteLogs = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.vote_log.index')->with('voteLogs', $voteLogs)->with('vote', $vote);
    }


}