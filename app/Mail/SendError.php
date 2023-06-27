<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendError extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public function __construct($data)
    {
        $this->subject('[sale.baohiemoto.vn] Thông báo có lỗi xảy ra');
        $this->data = $data;
    }
    public function build()
    {
        return $this->subject($this->subject)->replyTo('thanhan1507@gmail.com','sale.baohiemoto.vn')
            ->view('frontend::mail.booking',['details'=>$this->data]);
    }
}
