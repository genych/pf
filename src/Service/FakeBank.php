<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Order;

class FakeBank
{
    const INITIAL_BALANCE = 10000;

    public static function fromMinorUnits(?int $amount): string
    {
        return sprintf("%.2f", round((int)$amount / 100, 2));
    }

    public static function getBalance(Customer $customer): int
    {
        $prices = $customer->getOrders()->map(function(Order $o) {return $o->getPrice();});
        return self::INITIAL_BALANCE - array_sum($prices->toArray());
    }
}
