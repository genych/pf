<?php

namespace App\Entity;

use App\Repository\ShippingPriceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingPriceRepository::class)
 */
class ShippingPrice
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $firstDomestic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $firstWorldwide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $restDomestic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $restWorldWide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $expressDomestic;

    /**
     * @param int|null $firstDomestic
     * @param int|null $firstWorldwide
     * @param int|null $restDomestic
     * @param int|null $restWorldWide
     * @param int|null $expressDomestic
     */
    public function __construct(
        ?int $firstDomestic,
        ?int $firstWorldwide,
        ?int $restDomestic,
        ?int $restWorldWide,
        ?int $expressDomestic
    ) {
        $this->firstDomestic   = $firstDomestic;
        $this->firstWorldwide  = $firstWorldwide;
        $this->restDomestic    = $restDomestic;
        $this->restWorldWide   = $restWorldWide;
        $this->expressDomestic = $expressDomestic;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstDomestic(): ?int
    {
        return $this->firstDomestic;
    }

    public function getFirstWorldwide(): ?int
    {
        return $this->firstWorldwide;
    }

    public function getRestDomestic(): ?int
    {
        return $this->restDomestic;
    }

    public function getRestWorldWide(): ?int
    {
        return $this->restWorldWide;
    }

    public function getExpressDomestic(): ?int
    {
        return $this->expressDomestic;
    }
}
