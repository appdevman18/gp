<?php

namespace App\Services\Scrapers;


final class SulpakScraper extends BaseScraper
{
    public $titleElement = 'h1';
    public $priceElement = '.product-price-block > .current-price > span.sum';

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->getTitle($this->titleElement);
    }

    /**
     * @return string
     */
    public function price(): string
    {
        return $this->getPrice($this->priceElement);
    }

}