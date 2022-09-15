<?php
/**
 * ClassName: VotePlayerController
 * 投票候选人控制器
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

class VotePlayerController extends Controller
{  
    private $prefixName = 'vote_player_img';
    public function __construct()
    {  
         
    }

    /**
     * 投票候选人列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request, $id)
    {
        $vote = Vote::find($id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This voting does not exist.');
        }
        $votePlayerModel = new VotePlayer();
        $query = $votePlayerModel->query();
        $query->where('vote_id', '=', $id);
        $query->where('is_delete', '=', 0);
        $votePlayers = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.vote_player.index')->with('votePlayers', $votePlayers)->with('vote', $vote);
    }

    /**
     * 创建投票候选人
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request, $id)
    {
        $vote = Vote::find($id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This voting does not exist.');
        }
        $voteGroup = $vote->getGroupOption();
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            $fileName = $this->prefixName.'_'.time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            if (!$fileName) {
                return Redirect::back()->withErrors(['message' => 'Failed to upload an image.']);
            }
            $pid = VotePlayer::create([
                'code' => $request->get('code'),
                'vote_id' => $id,
                'group_id' => $request->get('group_id'),
                'name' => $request->get('name'),
                'content' => $request->get('content'),
                'img' => $fileName,
                'is_active' => $request->get('is_active') == 'on' ? 1 : 0,
                'sort' => $request->get('sort'),
            ])->id;
            if($pid) {
                $this->updateVotePlayerById($id);
                return Redirect::route('vote-player', $id)->with(['message' => 'Created a new vote player successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new vote player.']);
            }
        }
        return view('backend.vote_player.create')->with('vote', $vote)->with('voteGroup', $voteGroup);
    }

    /**
     * 修改投票候选人
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $votePlayer = VotePlayer::find($id);
        if(!$votePlayer) {
            return Redirect::back()->with('message', 'This vote player does not exist.');
        }
        $vote = Vote::find($votePlayer->vote_id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This voting does not exist.');
        }
        $voteGroup = $vote->getGroupOption();
        if($request->has('submit')) {
            $validator = $request->validate( [
                'name' => 'required|string|max:25',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            if ($request->image) {
                $fileName = $this->prefixName.'_'.time().'.'.$request->image->extension();
                $request->image->move(public_path('images'), $fileName);
                if (!$fileName) {
                    return Redirect::back()->withErrors(['message' => 'Failed to upload an image.']);
                }
            }
            $votePlayer->code = $request->get('code');
            $votePlayer->vote_id = $votePlayer->vote_id;
            $votePlayer->group_id = $request->get('group_id');
            $votePlayer->name = $request->get('name');
            $votePlayer->content = $request->get('content');
            $votePlayer->img = $request->image ? $fileName : $votePlayer->img;
            $votePlayer->is_active = $request->get('is_active') == 'on' ? 1 : 0;
            $votePlayer->sort = $request->get('sort');
            if(!$votePlayer->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this vote player.']);
            }   
           return Redirect::back()->with(['message' => 'Update vote player successfuly.']);
        }
        return view('backend.vote_player.edit',compact('votePlayer'))->with('vote', $vote)->with('voteGroup', $voteGroup);
    }

    /**
     * 删除投票候选人
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        $votePlayer = VotePlayer::find($id);
        if(!$votePlayer) {
            return Redirect::back()->with('message', 'This vote player does not exist.');
        }
        $vid = $votePlayer->vote_id;
        $votePlayer->is_delete = 1;
        $votePlayer->deleted_at = date('Y-m-d H:i:s', time());
        if(!$votePlayer->save()){
            return Redirect::back()->withErrors(['message' => 'Failed to delete this vote player del.']);
        }   
        $this->updateVotePlayerById($vid);
        return Redirect::back()->with(['message' => 'Delete vote player successfuly.']);
    }

    private function updateVotePlayerById($id) {
        $vote = Vote::find($id);
        $votePlayerModel = new VotePlayer();
        $query = $votePlayerModel->query();
        $query->where('vote_id', '=', $id);
        $query->where('is_delete', '=', 0);
        $vote->player_count = $query->where('vote_id', '=', $id)->count();
        $vote->save();
    }

}