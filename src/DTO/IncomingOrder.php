<?php declare(strict_types=1);

namespace App\DTO;

class IncomingOrder
{
    private int $user;
    private ShippingInfo $shippingInfo;
    /** @var Thing[] */
    private array $items;
    private bool $express;

    /**
     * @param int          $user
     * @param ShippingInfo $shippingInfo
     * @param Thing[]      $items
     * @param bool         $express
     */
    public function __construct(int $user, ShippingInfo $shippingInfo, array $items, bool $express)
    {
        $this->user         = $user;
        $this->shippingInfo = $shippingInfo;
        $this->items        = $items;
        $this->express = $express;
    }

    /**
     * @return int
     */
    public function getUser(): int
    {
        return $this->user;
    }

    /**
     * @return ShippingInfo
     */
    public function getShippingInfo(): ShippingInfo
    {
        return $this->shippingInfo;
    }

    /**
     * @return Thing[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return bool
     */
    public function isExpress(): bool
    {
        return $this->express;
    }
}
