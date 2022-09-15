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
        $query->where('vote_id', '=', $this->id);
        $query->where('is_delete', '=', 0);
        $votePlayers = $query->orderBy('vote_count', 'desc')->limit(10)->get()->toArray();
        return response()->json(['code' => 200, 'data' => $votePlayers]);
    }

    /**
     * 短信验证码发送
     * @param $phone
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function phoneVerification(Request $request) {
        // phone format verification
        // $req->validate([
        //     'phone' => 'required|regex:/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/u',
        // ]);
        try {
            $verification = $this->twilio->verify->v2->services($this->service_sid)
                ->verifications
                ->create("+1".$request->get('phone'), "sms");
        } catch (\Exception $exception) {
            return \Response::json([
                "code" => 444,
                "message" => "Invalid phone number"], 403);
        }
        return \Response::json(["code" => 100, 
            'message' =>  "verification code sent to phone " . $verification->to . "; please verify in one minute.",
        ], 200);
    }

    /**
     * 短信验证码验证
     * @param $phone
     * @param $code
     * @return bool
     * @throws \Twilio\Exceptions\TwilioException
     */
    public function phoneVerificationCheck(Request $request) {
        try {                                   
            $verification_check = $this->twilio->verify->v2->services($this->service_sid)
                ->verificationChecks
                ->create($request->get('code'), // code
                    ["to" => "+1" . $request->get('phone')]
                );
        } catch (\Exception $e) {
            return false;
        }
        return  true;
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
