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
        $this->subject('[sale.baohiemoto.vn] Thông báo có đơn tư vấn từ Landing page sale.baohiemoto.vn');
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->replyTo('thanhan1507@gmail.com','sale.baohiemoto.vn')
            ->view('frontend::mail.booking',['details'=>$this->data]);
    }
}
