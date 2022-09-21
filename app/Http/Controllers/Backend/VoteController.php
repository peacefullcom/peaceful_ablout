<?php
/**
 * ClassName: VoteController
 * 投票控制器
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

class VoteController extends Controller
{  
    public function __construct()
    {  
         
    }

    /**
     * 投票列表
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $voteModel = new Vote();
        $query = $voteModel->query();
        $query->where('is_delete', '=', 0);
        $votes = $query->orderBy('id', 'asc')->paginate(20);
        return view('backend.vote.index')->with('votes', $votes);
    }

    /**
     * 投票分类
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'day_votes' => 'required|integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            if($request->get('date_range')) {
                $date_range = explode('-', $request->get('date_range'));
            }
            $id = Vote::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'day_votes' => $request->get('day_votes'),
                'rule' => $request->get('rule'),
                'group' => $request->get('group'),
                'start_at' => isset($date_range[0]) ? $date_range[0] : '',
                'end_at' => isset($date_range[1]) ? $date_range[1] : '',
            ])->id;
            if($id) {
                return Redirect::route('vote')->with(['message' => 'Created a new voting successfuly.']);
            } else {
                return Redirect::back()->withErrors(['message' => 'Failed to created a new voting.']);
            }
        }
        return view('backend.vote.create');
    }

    /**
     * 修改投票
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request, $id)
    {
        $vote = Vote::find($id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This voting does not exist.');
        }
        if($request->has('submit')) {
            $validator = $request->validate( [
                'title' => 'required|string|max:25',
                'day_votes' => 'required|integer|max:99',
            ]);
            if(!$validator) {
                return Redirect::back()->withErrors();
            }
            if($request->get('date_range')) {
                $date_range = explode('-', $request->get('date_range'));
            }
            $vote->title = $request->get('title');
            $vote->content = $request->get('content');
            $vote->day_votes = $request->get('day_votes');
            $vote->rule = $request->get('rule');
            $vote->group = $request->get('group');
            $vote->start_at = isset($date_range[0]) ? $date_range[0] : '';
            $vote->end_at = isset($date_range[1]) ? $date_range[1] : '';
           if(!$vote->save()){
                return Redirect::back()->withErrors(['message' => 'Failed to upate this voting.']);
           }
           return Redirect::back()->with(['message' => 'Update voting successfuly.']);
        }
        return view('backend.vote.edit',compact('vote'));
    }

    /**
     * 删除投票
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request, $id)
    {
        $vote = Vote::find($id);
        if(!$vote) {
            return Redirect::back()->with('message', 'This vote does not exist.');
        }
        $vote->is_delete = 1;
        $vote->deleted_at = date('Y-m-d H:i:s', time());
        if(!$vote->save()){
            return Redirect::back()->withErrors(['message' => 'Failed to delete this voting.']);
        }
        return Redirect::back()->with(['message' => 'Delete voting successfuly.']);
    }

}