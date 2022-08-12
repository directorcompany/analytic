<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\Check;

// use App\Jobs\UrlVerify;
class UrlVerify implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries;

    /**
    * The number of seconds to wait before retrying the job.
    *
    * @var int
    */
    public $backoff=60;

    /**
     * 
     * Model data
     * 
     * @var int
     */
    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        //
        $this->url = $url;
        $this->tries = $url->count;
    }

    /**
     * Execute the job. Commenting try catch to repeat failing and run url
     *
     * @return void
     */
    public function handle()
    {
     
        //   try {
            $url = ($this->url)->url;
            $response = Http::get($url);
            $attempt = $this->attempts();
            $status = ($response->status()) ?? 0;
        // } catch(\Exception $ex) {
            $attempt = $this->attempts();
            // (new Check())->store(compact('attempt','status','url'));
        // }
        (new Check())->store(compact('attempt','status','url'));
       
    }
   
}
