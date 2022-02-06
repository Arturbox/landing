<?php

namespace App\Jobs;

use App\Facades\JRpcClient;
use Datto\JsonRpc\Http\Exceptions\HttpException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddImpression implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $url;
    protected string $datetime;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->datetime = now()->format('Y-m-d H:i:s');
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            JRpcClient::notify('addImpression', ['url' => $this->url, 'datetime' => $this->datetime])->send();
        } catch (HttpException | \ErrorException $e) {
            Log::error($e);
        }
    }
}
