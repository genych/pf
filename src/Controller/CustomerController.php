<?php

namespace App\Controller;

use App\DTO\IncomingOrder;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Service\FakeBank;
use App\Service\Seller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

// TODO: catch
class CustomerController extends AbstractController
{
    /**
     * @Route("/user", methods={"POST"})
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function make(EntityManagerInterface $em): JsonResponse
    {
// TODO: move to service
        $customer = new Customer();
        $em->persist($customer);
        $em->flush();

// TODO: dto
        return $this->json(['id' => $customer->getId(), 'balance' => FakeBank::fromMinorUnits(FakeBank::INITIAL_BALANCE)]);
    }

    /**
     * @Route("/user/{id<\d+>}", methods={"GET"})
     * @param CustomerRepository $customerRepository
     * @param FakeBank           $bank
     * @param int                $id
     * @return JsonResponse
     */
    public function poke(CustomerRepository $customerRepository, FakeBank $bank, int $id): JsonResponse
    {
// TODO: move
        $customer = $customerRepository->find($id);
        if (!$customer) {
            throw new Exception('user not found');
        }
        
        return $this->json([
            'id' => $customer->getId(), 'balance' => FakeBank::fromMinorUnits($bank->getBalance($id))
        ]);
    }

    /**
     * @Route("/order", methods={"POST"})
     * @param Request             $request
     * @param SerializerInterface $serializer
     * @param Seller              $seller
     * @return JsonResponse
     */
    public function order(Request $request, SerializerInterface $serializer, Seller $seller): JsonResponse
    {
        /** @var IncomingOrder $incomingOrder */
        $incomingOrder = $serializer->deserialize($request->getContent(), IncomingOrder::class, 'json');
        $order         = $seller->take($incomingOrder);

        return $this->json(['order' => $order->getId(), 'price' => FakeBank::fromMinorUnits($order->getPrice())]);
    }
}
