<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\IncomingOrder;
use App\Entity\Order;
use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;

class Seller
{
    /** @var CustomerRepository */
    private CustomerRepository $customerRepository;
    /** @var EntityManagerInterface */
    private EntityManagerInterface $em;

    /**
     * @param CustomerRepository     $customerRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(CustomerRepository $customerRepository, EntityManagerInterface $em)
    {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
    }

    public function take(IncomingOrder $incomingOrder): Order
    {

    }
}
