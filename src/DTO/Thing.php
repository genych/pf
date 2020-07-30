<?php declare(strict_types=1);

namespace App\DTO;

class Thing
{
    private string $sku;
    private int $quantity;

    /**
     * @param string $sku
     * @param int    $quantity
     */
    public function __construct(string $sku, int $quantity)
    {
        $this->sku      = $sku;
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getSku(): string
    {
        return $this->sku;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
