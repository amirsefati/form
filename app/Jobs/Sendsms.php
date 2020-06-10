<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Ipecompany\Smsirlaravel\Smsirlaravel;

class Sendsms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $name;
    public $code;
    public $phone;

    public function __construct($name,$phone,$code)
    {
      $this->name = $name;
      $this->phone = $phone;  
      $this->code = $code;  
  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Smsirlaravel::ultraFastSend(['name'=>$this->name,'phone'=>$this->phone,'code'=>$this->code],26866,$this->phone);

    }
}
