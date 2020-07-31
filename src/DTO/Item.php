<?php declare(strict_types=1);

namespace App\DTO;

class Item
{
    private string $sku;
    private string $title;
    private Pricing $pricing;

    /**
     * @param string  $sku
     * @param string  $title
     * @param Pricing $pricing
     */
    public function __construct(string $sku, string $title, Pricing $pricing)
    {
        $this->sku     = $sku;
        $this->title   = $title;
        $this->pricing = $pricing;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Pricing
     */
    public function getPricing(): Pricing
    {
        return $this->pricing;
    }
}
