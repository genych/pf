<?php

namespace App\Entity;

use App\Repository\PackageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PackageRepository::class)
 */
class Package
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
    private int $quantity;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private Item $item;

    /**
     * @param int  $quantity
     * @param Item $item
     */
    public function __construct(int $quantity, Item $item)
    {
        $this->quantity = $quantity;
        $this->item     = $item;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function getItem(): Item
    {
        return $this->item;
    }
}
