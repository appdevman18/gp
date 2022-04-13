<?php

namespace App\Services\Scrapers;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Product;
use App\Services\Product\ProductService;

class BaseScraper
{
    /**
     * @var Client $client
     * @var Crawler $crawler
     */
    public $client;
    public $crawler;

    /**
     * BaseScraper constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param string $url
     * @return \Illuminate\Http\RedirectResponse|mixed
     * @throws \Exception
     */
    public function chooseScraper(string $url)
    {
        $store = $this->getStore($url);
        $checkStore = $this->checkSupportStore($store);

        if ($checkStore) {

            $scraper = 'App\Services\Scrapers\\' . ucfirst($store) . 'Scraper';

            if (!$scraper) {

                throw new \Exception('The non-existent scraper class');

                return back()->with('error', 'Store not supported. Please, see supported stores.');
            }

            return new $scraper();

        } else {

            return back()->with('error', 'Your link is not supported.');
        }

    }

    /**
     * @param string $url
     * @return Crawler
     */
    public function webCrawler(string $url): Crawler
    {
        return $this->crawler = $this->client->request('GET', $url);
    }

    /**
     * @param string $url
     * @return string
     */
    public function getStore(string $url): string
    {
        $host = $this->getHost($url);
        $hostParts = explode('.', $host);
        $store = $hostParts[0];

        return $store;
    }

    /**
     * @param string $element
     * @return string
     */
    public function getTitle(string $element): string
    {
        $title = $this->crawler->filter($element)->text();

        return $title;
    }

    /**
     * @param string $element
     * @return string
     */
    public function getPrice(string $element): string
    {
        $price = $this->crawler->filter($element)->text();
        $price = $this->getOnlyDigits(trim($price));

        return $price;
    }

    /**
     * @param string $url
     * @return string
     */
    private function getHost(string $url): string
    {
        $host = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));

        return $host;
    }

    /**
     * @param string $str
     * @return string
     */
    private function getOnlyDigits(string $str): string
    {
        return preg_replace('/[^0-9]/', '', $str);
    }

    /**
     * @param $store
     * @return bool
     */
    private function checkSupportStore($store)
    {
        $stores = (new ProductService())->getAllStores();

        return in_array($store, $stores);
    }
}
