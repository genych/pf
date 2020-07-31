<?php declare(strict_types=1);

namespace App\DTO;

class Item
{
    private string $sku;
    private Pricing $pricing;

    /**
     * @param string  $sku
     * @param Pricing $pricing
     */
    public function __construct(string $sku, Pricing $pricing)
    {
        $this->sku     = $sku;
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
     * @return Pricing
     */
    public function getPricing(): Pricing
    {
        return $this->pricing;
    }
}
