<?php

namespace App\Services\Scrapers;


final class MechtaScraper extends BaseScraper
{
    public $titleElement = '.detail-info__name';
    public $priceElement = '.detail-price > .detail-price__total > .price';

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