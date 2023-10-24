<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$content = [])
    {
        $this->subject = 'Chào mừng bạn đã gia nhập hệ thống';
        $this->content = $content;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->subject)->to($this->data)->view('email.email', [
            'data' => $this->data,
            'content' =>$this->content
        ]);
    }
}
