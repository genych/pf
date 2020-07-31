<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @ORM\ManyToOne(targetEntity=ShippingInfo::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private ShippingInfo $shippingInfo;

    /**
     * @ORM\ManyToMany(targetEntity=Package::class, cascade={"persist", "remove"})
     */
    private Collection $packages;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orders", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Customer $customer;

    /**
     * @param int             $price
     * @param ShippingInfo    $shippingInfo
     * @param Collection      $packages
     * @param Customer        $customer
     */
    public function __construct(int $price, ShippingInfo $shippingInfo, Collection $packages, Customer $customer)
    {
        $this->price        = $price;
        $this->shippingInfo = $shippingInfo;
        $this->packages     = $packages;
        $this->customer     = $customer;

        $customer->addOrder($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getShippingInfo(): ?ShippingInfo
    {
        return $this->shippingInfo;
    }

    /**
     * @return Collection|Package[]
     */
    public function getPackages(): Collection
    {
        return $this->packages;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }
}
