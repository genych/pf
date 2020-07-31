<?php

namespace App\Controller;

use App\DTO\IncomingOrder;
use App\DTO\Item;
use App\DTO\Pricing;
use App\DTO\User;
use App\Entity\Customer;
use App\Repository\ItemRepository;
use App\Service\FakeBank;
use App\Service\Seller;
use App\Validator\OfEverything;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

// TODO: catch and provide reasonable errors/codes
class EverythingController extends AbstractController
{
    /**
     * @Route("/user", methods={"POST"})
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function makeCustomer(EntityManagerInterface $em): JsonResponse
    {
// TODO: move to service
        $customer = new Customer();
        $em->persist($customer);
        $em->flush();

        return $this->json(new User($customer->getId(), FakeBank::fromMinorUnits(FakeBank::INITIAL_BALANCE)));
    }

    /**
     * @Route("/user/{id<\d+>}", methods={"GET"})
     * @param OfEverything       $validator
     * @param int                $id
     * @return JsonResponse
     */
    public function getCustomer(OfEverything $validator, int $id): JsonResponse
    {
        $customer = $validator->validateCustomer($id);
        return $this->json(new User($customer->getId(), FakeBank::fromMinorUnits(FakeBank::getBalance($customer))));
    }

    /**
     * @Route("/items", methods={"GET"})
     * @param ItemRepository $itemRepository
     * @return JsonResponse
     */
    public function getItems(ItemRepository $itemRepository): JsonResponse
    {
        $items = [];
        foreach ($itemRepository->findAll() as $item) {
            $shippingPrices = $item->getShipping();
            $pricing = new Pricing(
                FakeBank::fromMinorUnits($shippingPrices->getFirstDomestic()),
                FakeBank::fromMinorUnits($shippingPrices->getFirstWorldwide()),
                FakeBank::fromMinorUnits($shippingPrices->getRestDomestic()),
                FakeBank::fromMinorUnits($shippingPrices->getRestWorldWide()),
                FakeBank::fromMinorUnits($shippingPrices->getExpressDomestic())
            );

            $items[] = new Item($item->getSku(), $pricing);

        }

        return $this->json($items);
    }

    /**
     * @Route("/order", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     * @param Seller              $seller
     * @param OfEverything        $validator
     * @return JsonResponse
     */
    public function order(Request $request, SerializerInterface $serializer, Seller $seller, OfEverything $validator): JsonResponse
    {
        /** @var IncomingOrder $incomingOrder */
        $incomingOrder = $serializer->deserialize($request->getContent(), IncomingOrder::class, 'json');

        $order = $seller->take($validator->validateEverything($incomingOrder));

        return $this->json(['order' => $order->getId(), 'price' => FakeBank::fromMinorUnits($order->getPrice())]);
    }
}
