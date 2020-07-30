<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Customer;
use App\Entity\Order;
use App\Repository\CustomerRepository;

class FakeBank
{
    const INITIAL_BALANCE = 10000;

    /** @var CustomerRepository */
    private CustomerRepository $customerRepository;

    /**
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public static function fromMinorUnits(int $amount): string
    {
        return sprintf("%.2f", round($amount / 100, 2));
    }

    public function getBalance(Customer $customer): int
    {
        $prices = $customer->getOrders()->map(function(Order $o) {return $o->getPrice();});
        return self::INITIAL_BALANCE - array_sum($prices->toArray());
    }
}
