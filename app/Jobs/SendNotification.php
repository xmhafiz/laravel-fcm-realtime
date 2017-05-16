<?php

namespace App\Jobs;

use App\Http\NotificationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $token;
    protected $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($token, $payload)
    {
        $this->token = $token;
        $this->payload = $payload;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        NotificationService::pushFirebase($this->token, $this->payload);
    }
}
