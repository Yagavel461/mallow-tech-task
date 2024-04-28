<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailTest; // Update the import to use the correct Mailable class

class SendEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;

    }

    public function handle()
    {
        Mail::to($this->data['customer_email'])->send(new SendEmailTest($this->data));
    }
}
