<?php

namespace App\Http\Controllers\Scrape;

use App\Http\Controllers\Scrape\BaseScrapeController as Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\Scrapers\BaseScraper;
use App\Http\Requests\Scrape\CheckUrlRequest;


class ScrapeController extends Controller
{
    /**
     * @param CheckUrlRequest $request
     * @param BaseScraper $webScraper
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function checkUrl(CheckUrlRequest $request, BaseScraper $webScraper)
    {
        $url = ($request['url']);

        $scraper = $webScraper->chooseScraper($url);
        $scraper->webCrawler($url);

        $title = $scraper->title();
        $price = $scraper->price();
        $store = $scraper->getStore($url);
        if (! auth()->user()->hasRole('admin')){

            return redirect()->route('profile.products.create', [ $title, $price, $store, $url ]);
        } else {

            return redirect()->route('products.create', [ $title, $price, $store, $url ]);
        }
    }

}
