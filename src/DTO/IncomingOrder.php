<?php declare(strict_types=1);

namespace App\DTO;

class IncomingOrder
{
    private int $user;
    private ShippingInfo $shippingInfo;
    /** @var Thing[] */
    private array $items;

    /**
     * @param int          $user
     * @param ShippingInfo $shippingInfo
     * @param Thing[]      $items
     */
    public function __construct(int $user, ShippingInfo $shippingInfo, array $items)
    {
        $this->user         = $user;
        $this->shippingInfo = $shippingInfo;
        $this->items        = $items;
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
}
