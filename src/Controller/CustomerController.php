<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CustomerController extends AbstractController
{
    /**
     * @Route("/user", methods={"POST"})
     */
    public function make()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CustomerController.php',
        ]);
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function getThem(CustomerRepository $customerRepository)
    {
        return $this->json($customerRepository->findAll());
    }
}
