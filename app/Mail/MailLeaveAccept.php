<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class MailLeaveAccept extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Build the message.
     *
     * @return $this
     */
public function build()
    {
        return $this->from('admin@hr-system.com', 'Mailtrap')
            ->subject('Akceptacja ulopu')
            ->markdown('mails.leave-accept')
            ->with([
                'name' => \Auth::user()->first_name." ".\Auth::user()->last_name,
                'link' => 'http://localhost:8000/mojeurlopy'
            ]);
    }
}