<?php

namespace App\Observers\Observer;

use App\Models\Products;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Symfony\Component\DomCrawler\Crawler;
use Spatie\Crawler\CrawlObservers\CrawlObserver;

class EPonudaObserver extends CrawlObserver
{
    private string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }

    /*
     * Called when the crawler will crawl the url.
     */
    public function willCrawl(UriInterface $url, ?string $linkText): void
    {
        Log::info('willCrawl', ['url' => $url]);
    }

    /*
     * Called when the crawler has crawled the given url successfully.
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::info("Crawled: {$url}");

        $crawler = new Crawler((string) $response->getBody());
        
        $crawler->filter('div[class="relative item-box text-center p-3 relative"]')
        ->each(function ($node) {
            Products::updateOrCreate(
                ['name' => $node->filter('img')->first()->attr('title'), 'price' => $node->filter('span > strong')->first()->html(), 'category' => $this->category,],
                ['image_link' => $node->filter('img')->first()->attr('src')]
            );
        });
    }

    /*
     * Called when the crawler had a problem crawling the given url.
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void {
        Log::error("Failed: {$url}");
    }

    /*
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
        Log::info("Finished crawling");
    }
}
