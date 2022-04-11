<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Result;
use App\Models\DayWinner;
use App\Device;

use Carbon\Carbon;

class DailyWinner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'winner:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Winner.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $win = Result::where('status','pass')->whereDate('created_at',Carbon::yesterday()->format("Y-m-d"))->inRandomOrder()->first();
        $userid = Device::where('user_id',$win->added_by)->latest()->first();

        if ($userid) {
            $db= DayWinner::create([
                'date' => Carbon::yesterday()->format("Y-m-d"),
                'user_id' => $win->added_by,
            ]);
            $ch = Device::where('user_id',$win->added_by)->latest()->first();

            $api_access_key = 'AAAAtwlLiu8:APA91bELcsaHJLKh4eedSvrxeIjyULvdpr5OHzdrD6qn1Y38QlV-fs_xEH9W_t4L5a_1phwLbOa6ub6oyQRooH7HszFDNhuNP_Sp7InZrjGT64Pz3Ag6ocgDVtoX6KTXqBfPl3KjG6Hr';
                    
            $notification['device_token'] = str_replace(array('.', "\n", "\t", "\r"), '', $ch->token);
            $singleID = $notification['device_token'];
            // return response()->json([str_replace(array('.', "\n", "\t", "\r"), '', $tok->token), $notification]);
            if($notification['device_token'] != "" ){
                #prep the bundle
                $msg = array
                    (
                    'body' 	=> "You are the winner of yesterday's quiz.",
                    'title'	=> 'Congratulation.',
                    'icon'	=> '{{asset("plugins/logo1.png")}}',/*Default Icon*/
                    'sound' => 'mySound',/*Default sound*/
                    );

                $fields = array
                        (
                            //'to'		=> $registrationIds,
                            'to' => $singleID,
                            'priority' => 'high',
                            'notification'	=> $msg,
                            'data' => [
                                // "chat_user_id"=>$notification['chat_user_id'],
                                "date"=>date('Y-m-d'),
                                "news_detail" => '',
                                "video_detail" => '',
                                "mass_detail" => '',
                                "quiz_detail" => 'Contact us.'

                                // 'type_id' => $notification['notification_type_id'],
                                // 'page'=>$notification['noticification_type']
                                ]
                        );

                $headers = array
                        (
                            // 'Authorization: key=' . $api_access_key,
                            'Authorization: Bearer '. $api_access_key,
                            'Content-Type: application/json'
                        );
                #Send Reponse To FireBase Server
                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
                curl_setopt( $ch,CURLOPT_POST, true );
                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                $result = curl_exec($ch );
                curl_close( $ch );
                #Echo Result Of FireBase Server
                // echo $result;
                // $result = json_decode($result);
                // print_r($result);die();
            }
           
        }

        $this->info('Successfully inform to winner.');

    }
}
