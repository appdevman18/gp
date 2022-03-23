<?php

namespace App\Http\Controllers\Scrape;

use App\Http\Controllers\Scrape\BaseScrapeController as Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Scrapers\BaseScraper;
use App\Http\Requests\Scrape\CheckUrlRequest;


class ScrapeController extends Controller
{

    public function checkUrl(CheckUrlRequest $request, BaseScraper $webScraper)
    {
        $url = ($request['url']);

        $scraper = $webScraper->chooseScraper($url);
        $scraper->webCrawler($url);

        $title = $scraper->title();
        $price = $scraper->price();
        $store = $scraper->getStore($url);

        return redirect()->route('products.create', [ $title, $price, $store, $url ]);
    }

}
