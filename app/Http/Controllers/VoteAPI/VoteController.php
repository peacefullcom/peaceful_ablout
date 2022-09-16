<?php
/**
 * ClassName: VoteController
 * 投票API控制器
 * @author      David<guochaowan2008@gmail.com>
 * @version     v1.1.0
 */

namespace App\Http\Controllers\VoteAPI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Vote;
use App\Models\VotePlayer;
use App\Models\VoteVerifyCode;
use Twilio\Rest\Client;

class VoteController extends Controller
{
    private $id;

    private $sid;
    private $token;
    private $service_sid;
    private $twilio;
    private $fromPhone;



    function __construct()
    {
        $this->id = 2;
        $this->sid = env('TWILIO_SID');
        $this->token = env('TWILIO_TOKEN');
        $this->service_sid = env('TWILIO_SERVICE_SID');
        $this->twilio = new Client($this->sid, $this->token);
        $this->fromPhone = env('TWILIO_FROM_PHONE');
    }
    /**
     * 获取投票信息
     * @param Request $request
     * @return json
     */
    public function getVote() {
        $vote = Vote::find($this->id)->toArray();
        if(!$vote) {
            return response()->json([
                'code' => 400,
                'message' => 'This voting does not exist.'
            ]);
        }
        return response()->json(['code' => 200, 'data' => $vote]);
    }

    /**
     * 候选人列表
     * @param Request $request
     * @return json
     */
    public function getPlayerList() {
        $vote = Vote::find($this->id)->toArray();
        if(!$vote) {
            return response()->json([
                'code' => 400,
                'message' => 'This voting does not exist.'
            ]);
        }
        $votePlayerModel = new VotePlayer();
        $query = $votePlayerModel->query();
        $query->where('vote_id', '=', $this->id);
        $query->where('is_delete', '=', 0);
        $votePlayers = $query->orderBy('id', 'asc')->get()->toArray();
        return response()->json(['code' => 200, 'data' => $votePlayers]);
    }

    /**
     * 候选人详情
     * @param Request $request
     * @return json
     */
    public function getPlayerByCode($code) {
        $vote = Vote::find($this->id)->toArray();
        if(!$vote) {
            return response()->json([
                'code' => 400,
                'message' => 'This voting does not exist.'
            ]);
        }
        $votePlayerModel = new VotePlayer();
        $query = $votePlayerModel->query();
        $query->where('vote_id', '=', $this->id);
        $query->where('is_delete', '=', 0)->Where(function ($query) use ($code) {
            $query->where('code', 'like', $code.'%')->orWhere(function ($query) use ($code) {
                $query->where('name', 'like', $code.'%');
            });
        });
        $votePlayers = $query->orderBy('id', 'asc')->get()->toArray();
        return response()->json(['code' => 200, 'data' => $votePlayers]);
    }

    /**
     * 候选人排行
     * @param Request $request
     * @return json
     */
    public function getRank() {
        $vote = Vote::find($this->id)->toArray();
        if(!$vote) {
            return response()->json([
                'code' => 400,
                'message' => 'This voting does not exist.'
            ]);
        }
        $votePlayerModel = new VotePlayer();
        $query = $votePlayerModel->query();
        $query->select('id', 'name', 'group_id', 'vote_count');
        $query->where('vote_id', '=', $this->id);
        $query->where('is_active', '=', 1);
        $query->where('is_delete', '=', 0);
        $votePlayers = $query->orderBy('vote_count', 'desc')->get()->toArray();
        $groups = [];
        foreach($votePlayers as $votePlayer) {
            if(!isset($groups[0]) || count($groups[0]) < 10) {
                $groups[0][] = $votePlayer;
            }
            if($votePlayer['group_id'] && (!isset($groups[$votePlayer['group_id']]) || count($groups[$votePlayer['group_id']]) < 10)) {
                $groups[$votePlayer['group_id']][] = $votePlayer;
            }
        }
        return response()->json(['code' => 200, 'data' => $votePlayers]);
    }

    /**
     * 短信验证码发送
     * @param $phone
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function phoneVerification(Request $request) {
        $phone = $request->get('phone');
        $count = VoteVerifyCode::where('phone','=',$phone)->where('created_at','>', strtotime(time() - 60 * 60 * 24))->count();
        if ($count > 10) {
            return response(['code' => 401,'status'=>'error','message'=>'Sending a short message exceeds the limit']);
        }
        
        $verifyCode = random_int(100000,999999);
        $expireTime = date('Y-m-d H:i:s', time() + 60 * 5);//5分钟
        $newCodeData = ['phone'=>$phone, 'code' => $verifyCode, 'expired_at'=>$expireTime];
        VoteVerifyCode::where('phone','=',$phone)->where('created_at','<', strtotime(time() - 60 * 60 * 24))->delete();
        try {
            $message = $this->twilio->messages->create("+1".$phone, // to
                           ["body" => "Your verify code is ". $verifyCode, "from" => $this->fromPhone]
                  );
        } catch (\Exception $exception) {
            return \Response::json([
                "code" => 444,
                "message" => "Invalid phone number"], 403);
        }
        VoteVerifyCode::create($newCodeData);
        return response()->json(['code' => 200, 'status'=>'success']);
    }

    /**
     * 短信验证码验证
     * @param $phone
     * @param $code
     * @return bool
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function phoneVerificationCheck(Request $request) {
        $phone = $request->get('phone');
        $code = $request->get('code');
        $verifyCode = VoteVerifyCode::where('status','=',0)->where('phone','=',$phone)->orderBy('id','DESC')->first();
        if($verifyCode) {
          $expireTime = strtotime($verifyCode->expired_at);
          if(time() < $expireTime && $code == $verifyCode->code) {
            $verifyCode->verified_at = date('Y-m-d H:i:s', time());
            $verifyCode->status = 1;
            $verifyCode->save();
            return response(['code' => 200,'status'=>'success','message'=>'Verify Success']);
          }
          elseif (time() > $expireTime) {
            $verifyCode->status = 2;
            $verifyCode->save();
            return response(['code' => 408,'status'=>'error','message'=>'Your code expired']);
          }
          else{
            return response(['code' => 403,'status'=>'error','message'=>'Your code input does not match, please type again']);
          }
        }
        else{
          return response(['code' => 404, 'status'=>'error', 'message'=>'No data found, please send again']);
        }
    }
/*
    public function sendSms(Request $req) {
        ini_set('max_execution_time', '0');
        $phone = '7788833501';
        $res = $this->sendSmsByTwilio($phone);
        echo $res;
    }

    private function sendSmsByTwilio($phone) {
        try {
            $message = $this->twilio->messages->create("+1".$phone, // to
                           ["body" => "您的验证码是12345", "from" => $this->fromPhone]
                  );
            return $message->sid;
        } catch (\Exception $exception) {
            return 'wrong number: '.$phone;
        }
    }
*/



}
