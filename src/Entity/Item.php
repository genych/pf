<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="guid")
     */
    private string $sku;

    /**
     * @ORM\Column(type="integer")
     */
    private int $price;

    /**
     * @ORM\OneToOne(targetEntity=ShippingPrice::class, cascade={"persist", "remove"})
     */
    private ShippingPrice $shipping;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @param $sku
     * @param $price
     * @param $shipping
     * @param $title
     */
    public function __construct(string $sku, int $price, string $title, ShippingPrice $shipping)
    {
        $this->sku      = $sku;
        $this->price    = $price;
        $this->shipping = $shipping;
        $this->title    = $title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getShipping(): ShippingPrice
    {
        return $this->shipping;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
