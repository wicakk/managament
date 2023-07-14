<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->data);
        return $this->markdown('emailku')
                    ->subject($this->data['title'])
                    ->with('data', $this->data)
                    ->attach(public_path('/assets/images/icon/08.png'), [
                        'as'    => '08.png',
                        'mime'  => 'image/png',
                    ]);
    }
}