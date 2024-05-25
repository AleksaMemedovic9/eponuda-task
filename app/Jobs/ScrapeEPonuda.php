<?php

namespace App\Jobs;

use App\Observers\Observer\EPonudaObserver;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Crawler\Crawler;

class ScrapeEPonuda implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $url = 'https://www.shoptok.si/televizorji/cene/206';
        Crawler::create()
            ->setCrawlObserver(new EPonudaObserver('televizori'))
            ->setMaximumDepth(0)
            ->setTotalCrawlLimit(1)
            ->startCrawling($url);

        $url = 'https://www.shoptok.si/tv-prijamnici/cene/56';
        Crawler::create()
        ->setCrawlObserver(new EPonudaObserver('tv prijemnici'))
        ->setMaximumDepth(0)
        ->setTotalCrawlLimit(1)
        ->startCrawling($url);
    }
}
