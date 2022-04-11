<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Poll;
use App\Models\Vote;
use App\Models\Voter;
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

class PollController extends Controller
{
    public function polling()
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            
            $p = Voter::where('user_id',auth('api')->user()->id)->pluck('poll_id')->toArray();
            if ($p == null) {
                $poll = Poll::with('vote_info')->whereStatus('active')
                // ->where('start','<=', Carbon::today()->format('Y-m-d'))
                ->where('end','<=', Carbon::today()->format('Y-m-d'))->get();
                foreach ($poll as $key => $value) {
                    $value->image_url = url('/upload/poll/'.$value->image);
                }
            }else{
                $poll = Poll::whereNotIn('id',$p)->whereStatus('active')
                // ->where('end','>=', Carbon::today()->format('Y-m-d'))
                ->with('vote_info')->where('end','<=', Carbon::today()->format('Y-m-d'))
                ->orderBy('id','asc')->get();
                foreach ($poll as $key => $value) {
                    $value->image_url = url('/upload/poll/'.$value->image);
                }
            }


            $up_poll = Poll::with('vote_info')->whereStatus('active')
            // ->where('end','>=', Carbon::today()->format('Y-m-d'))
            ->where('start','>', Carbon::today()->format('Y-m-d'))
            ->get();
            foreach ($up_poll as $key => $value) {
                $value->image_url = url('/upload/poll/'.$value->image);
            }

            $completed_poll = Poll::whereIn('id',$p)->with('vote_info')->get();
            foreach ($completed_poll as $key => $value) {
                $value->image_url = url('/upload/poll/'.$value->image);
              // return response()->json(['s'=>$value]);
               
              $t = Voter::where('poll_id',$value->id)->get()->count();
              foreach ($value->vote_info as $key => $item) {
                  $b = Voter::where('poll_id',$item->poll_id)->where('user_id',auth('api')->user()->id)->first();
                   if($item->id == $b->vote_id){
                    $item->my_vote = 'yes';

                   }else{
                     $item->my_vote = 'no';
                   }
                  $v = Voter::where('poll_id',$item->poll_id)->where('vote_id',$item->id)->count();
                  $item->percent = round($v / $t * 100);
            	}

            }
           
            
            // $com = Voter::where('user_id',auth('api')->user()->id)->get();
            // $voter = Voter::where('poll_id',$request->poll_id)->get();
            // $t = $voter->count();
            // $poll  = Poll::find($request->poll_id);
            // $poll->image_url = url('/upload/poll/'.$poll->image);
            // foreach ($poll->vote_info as $key => $value) {
            //     $v = Voter::where('vote_id',$value->id)->count();
            //     $value->percent = round($v / $t * 100);
            // }

            return response()->json([
                'current_polling' =>$poll,
                'upcoming_polling' => $up_poll,
                'completed_polling' => $completed_poll,
            ]);
        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }

    public function vote(Request $request)
    {
        if (Auth::guard('api')->check())
        {
            logger(Auth::guard('api')->user()); // to get user

            $vo = Voter::where('user_id',auth('api')->user()->id)->where('poll_id',$request->poll_id)->latest()->first();
            if ($vo) {
                $po = Poll::where('id',$vo->poll_id)->with('vote_info')->first();
                $po->image_url = url('/upload/poll/'.$po->image);
                $t = Voter::where('poll_id',$po->id)->get()->count();
                foreach ($po->vote_info as $key => $item) {
                    $b = Voter::where('poll_id',$item->poll_id)->where('user_id',auth('api')->user()->id)->first();
                    if($item->id == $b->vote_id){
                        $item->my_vote = 'yes';
                    }else{
                        $item->my_vote = 'no';
                    }
                    $v = Voter::where('poll_id',$item->poll_id)->where('vote_id',$item->id)->count();
                    $item->percent = round($v / $t * 100);
                }
            
                return response()->json([
                    'poll' => $po,
                    'message' => 'You cannot vote twice.',
                ],401);
            }
            $user_id = auth('api')->user()->id;
            $data = $request->all();
            $data['user_id'] = $user_id;
            $vote = Voter::create([
                'user_id' => $user_id,
                'poll_id' => $request->poll_id,
                'vote_id' => $request->vote_id,
            ]);

            $voter = Voter::where('poll_id',$request->poll_id)->get();
            $t = $voter->count();
            $poll  = Poll::find($request->poll_id);
            $poll->image_url = url('/upload/poll/'.$poll->image);
            foreach ($poll->vote_info as $key => $value) {
              	$m = Voter::where('poll_id',$request->poll_id)->where('user_id',auth('api')->user()->id)->first();
              	if($m->vote_id == $value->id){
                  $value->my_vote = 'yes';
                }else{
                  $value->my_vote = 'no';
                }
                $v = Voter::where('vote_id',$value->id)->count();
                $value->percent = round($v / $t * 100);
            }
           
            return response()->json([
                'poll' => $poll,
            ]);

        }else{
            return response()->json(['message'=>'Invalid access token'],401);
        }
    }
}
