<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\SendNewsletterNotification;
use Mail;
use App\Models\Newsletter;


class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $details;
    protected $newsletter_id;
    public function __construct($details, $newsletter_id)
    {
        $this->details = $details;
        $this->newsletter_id = $newsletter_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $n = Newsletter::where('id', $this->newsletter_id)->first();
        $email_contents = array(
            // "name" => $this->details->name,
            "email" => $this->details->email,
            "title" => $n->title,
            'content' => $n->message,
            // "msg" => json_decode($n->message),
            "attachment" => $n->attachment,
          
        );
       
        Mail::send('newsletter_email', $email_contents, function ($message) use ($email_contents) {
            $message->from('noreply@fstv.com', 'FireScreen Tv');
            $message->to($this->details->email); 
            $message->subject($email_contents['title']); 
            $message->attach(public_path('upload/newsletter/'.$email_contents['attachment']));                             
        }); 
    }
}
