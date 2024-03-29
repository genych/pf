<?php declare(strict_types=1);

namespace App\Validator;

use App\DTO\IncomingOrder;
use App\DTO\ShippingInfo;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Service\FakeBank;
use App\Service\Seller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OfEverything
{
    /** @var ValidatorInterface */
    private ValidatorInterface $validator;
    /** @var CustomerRepository */
    private CustomerRepository $customerRepository;
    /** @var Seller */
    private Seller $seller;

    /**
     * @param ValidatorInterface $validator
     * @param CustomerRepository $customerRepository
     * @param Seller             $seller
     */
    public function __construct(
        ValidatorInterface $validator,
        CustomerRepository $customerRepository,
        Seller $seller
    ) {
        $this->validator = $validator;
        $this->customerRepository = $customerRepository;
        $this->seller = $seller;
    }

// TODO: move out
    public static function isDomestic(ShippingInfo $shippingInfo): bool
    {
        return $shippingInfo->getCountry() === 'US';
    }

    public function validateEverything(IncomingOrder $order): IncomingOrder
    {
        $order = $this->validateOrder($order);
        $user = $this->validateCustomer($order->getUser());

        $price = $this->seller->calcPrice($order);
        $balanceIsOk = $this->validateBalance($user, $price);
        if (!$balanceIsOk) {
// TODO: tell how much
            throw new Exception('not enough funds');
        }

        return $order;
    }

    public function validateOrder(IncomingOrder $order): IncomingOrder
    {
        $violations = $this->validator->validate($order);

        if ($violations->count()) {
// TODO: lame, collect and return
            throw new Exception('bad request');
        }

        $shippingInfo = $order->getShippingInfo();

        if ($order->isExpress() && !self::isDomestic($shippingInfo)) {
            throw new Exception('no worldwide express');
        }

        if (self::isDomestic($shippingInfo)) {
            if (!($shippingInfo->getZip() && $shippingInfo->getState())) {
                throw new Exception('provide state and zip');
            }
        }

        return $order;
    }

    public function validateCustomer(int $customerId): Customer
    {
        $customer = $this->customerRepository->find($customerId);
        if (!$customer) {
            throw new Exception('user not found');
        }

        return $customer;
    }

    public function validateBalance(Customer $customer, int $price): bool
    {
        return FakeBank::getBalance($customer) > $price;
    }
}
