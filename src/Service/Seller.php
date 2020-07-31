<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\IncomingOrder;
use App\DTO\Thing;
use App\Entity\Item;
use App\Entity\Order;
use App\Entity\Package;
use App\Entity\ShippingInfo;
use App\Repository\CustomerRepository;
use App\Repository\ItemRepository;
use App\Validator\OfEverything;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class Seller
{
    /** @var CustomerRepository */
    private CustomerRepository $customerRepository;
    /** @var EntityManagerInterface */
    private EntityManagerInterface $em;
    /** @var ItemRepository */
    private ItemRepository $itemRepository;

    /**
     * @param CustomerRepository     $customerRepository
     * @param ItemRepository         $itemRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(
        CustomerRepository $customerRepository,
        ItemRepository $itemRepository,
        EntityManagerInterface $em
    ) {
        $this->customerRepository = $customerRepository;
        $this->em = $em;
        $this->itemRepository = $itemRepository;
    }

    public function take(IncomingOrder $incomingOrder): Order
    {
        $price = $this->calcPrice($incomingOrder);
        $si = $incomingOrder->getShippingInfo();

// TODO: adapter?
        $shippingInfo = new ShippingInfo(
            $si->getCountry(),
            $si->getCity(),
            $si->getAddress(),
            $si->getPhone(),
            $si->getName(),
            $si->getRegion(),
            $si->getState(),
            $si->getZip()
        );

        $packages = new ArrayCollection();
        foreach ($incomingOrder->getItems() as $thing) {
            $packages->add(new Package($thing->getQuantity(), $this->getItem($thing)));
        }
        $order = new Order($price, $shippingInfo, $packages, $this->customerRepository->find($incomingOrder->getUser()));

// TODO: find better place?
        $this->em->persist($order);
        $this->em->flush();

        return $order;
    }

    public function getItem(Thing $thing): Item
    {
        $sku = $thing->getSku();
        $item = $this->itemRepository->findOneBy(['sku' => $sku]);
        if (!$item) {
            throw new Exception("no such thing $sku");
        }
        
        return $item;
    }
    
    public function calcPrice(IncomingOrder $incomingOrder): int
    {
        $isExpress = $incomingOrder->isExpress();
        $isDomestic = OfEverything::isDomestic($incomingOrder->getShippingInfo());
        
        $price = 0;
        foreach ($incomingOrder->getItems() as $thing) {
            $item = $this->getItem($thing);
            $quantity = $thing->getQuantity();

            if ($quantity === 0) {
                continue;
            }

            $priceConstruction = $item->getShipping();
            if ($isExpress) {
                $firstPrice = $restPrice = $priceConstruction->getExpressDomestic();
            } elseif ($isDomestic) {
                $firstPrice = $priceConstruction->getFirstDomestic();
                $restPrice = $priceConstruction->getRestDomestic();
            } else {
                $firstPrice = $priceConstruction->getFirstWorldwide();
                $restPrice = $priceConstruction->getRestWorldWide();
            }

            $price += $firstPrice + ($quantity - 1) * $restPrice;

            assert($price > 0, 'no way');
        }

        return $price;
    }
}
