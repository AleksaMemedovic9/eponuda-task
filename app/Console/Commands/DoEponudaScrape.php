<?php

namespace App\Console\Commands;

use App\Jobs\ScrapeEPonuda;
use Illuminate\Console\Command;

class DoEponudaScrape extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:do-eponuda-scrape';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calls service that scrapes data from shoptalk for EPonuda task';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $job = new ScrapeEPonuda();
        $job->handle();
    }
}
