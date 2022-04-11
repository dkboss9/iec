<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voting;
use App\Models\VotingOption;
use App\Models\VotingResult;
use App\Users;
use Auth;
use Session;
use Validation;
use File;
use Mail;
use App\User;
use JWTAuth;
use App\Device;
use Carbon\Carbon;

class VotingController extends Controller
{
    public function votes()
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user
            
            $p = VotingResult::where('user_id',auth('api')->user()->id)->pluck('voting_id')->toArray();
            if ($p == null) {
                $voting = Voting::whereStatus('active')
                ->where('start', '<=', Carbon::now())
                ->where('end', '>=', Carbon::now())
                ->get();
                foreach ($voting as $key => $value) {
                    $value->image_url = url('/upload/voting/'.$value->image);
                }
            }else{
                $voting = Voting::whereNotIn('id',$p)->whereStatus('active')->orderBy('id','asc')->get();
                foreach ($voting as $key => $value) {
                    $value->image_url = url('/upload/voting/'.$value->image);
                }
            }

            return response()->json([
                'current_voting' =>$voting,
            ]);
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }

    public function voting($id)
    {
        if (Auth::guard('api')->check())
        {
           
            logger(Auth::guard('api')->user()); // to get user
            
            $voting = Voting::find($id);
            $voting->image_url = url('/upload/voting/'.$voting->image);
            $p = VotingOption::where('voting_id',$id)->whereStatus('active')->get();
            foreach ($p as $key => $value) {
                $value->image_url = url('/upload/participant/'.$value->photo);
            }
            $voting->participat_info = $p;
            return response()->json([
                'voting_participant' =>$voting,
            ]);
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }

    public function voted(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user
            $check = VotingOption::findOrFail($request->voption_id);
            if ($check->voting_id != $request->voting_id) {
                return response()->json(['message'=>'No Participant Found.'],401);
            }
            
            $vo = VotingResult::where('user_id',auth('api')->user()->id)->where('voting_id',$request->voting_id)->latest()->first();
            if ($vo) {
                $voting = Voting::where('id',$vo->voting_id)->with('participant_info')->first();
                $voting->image_url = url('/upload/voting/'.$voting->image);
                // $t = VotingResult::where('voting_id',$voting->id)->get()->count();
                if($voting){
                    foreach ($voting->participant_info as $key => $value) {   
                        $value->image_url = url('upload/participant'.$value->photo);                     
                        if ($value->id == $request->voption_id) {
                            $value->my_vote = 'yes';
                        }else{
                            $value->my_vote = 'no';
                        }      
                           
                    }
                }
                return response()->json([
                    'voting' => $voting,
                    'message' => 'You cannot vote twice.',
                ],401);
            }else{
                $user_id = auth('api')->user()->id;
                $data = $request->all();
                $data['user_id'] = $user_id;
                $vote = VotingResult::create([
                    'user_id' => $user_id,
                    'voting_id' => $request->voting_id,
                    'voption_id' => $request->voption_id,
                ]);
    
                $voter = VotingResult::where('voting_id',$request->voting_id)->get();
                $t = $voter->count();
                $voting  = Voting::find($request->voting_id);
                $voting->image_url = url('/upload/voting/'.$voting->image);
                foreach ($voting->participant_info as $key => $value) {
                  	$m = VotingResult::where('voting_id',$request->voting_id)->where('user_id',auth('api')->user()->id)->first();
                  	if($m->voption_id == $value->id){
                      $value->my_vote = 'yes';
                    }else{
                      $value->my_vote = 'no';
                    }
                    // $v = VotingResult::where('voption_id',$value->id)->count();
                    // $value->percent = round($v / $t * 100);
                }
            }           
            return response()->json([
                'voting' => $voting,
            ]);

        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }
  
  public function resultempty()
    {
        $da = VotingResult::truncate();
        return response()->json('table empty');
    }
}
