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
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $firstDomestic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $firstWorldwide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $restDomestic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $restWorldWide;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expressDomestic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstDomestic(): ?int
    {
        return $this->firstDomestic;
    }

    public function setFirstDomestic(?int $firstDomestic): self
    {
        $this->firstDomestic = $firstDomestic;

        return $this;
    }

    public function getFirstWorldwide(): ?int
    {
        return $this->firstWorldwide;
    }

    public function setFirstWorldwide(?int $firstWorldwide): self
    {
        $this->firstWorldwide = $firstWorldwide;

        return $this;
    }

    public function getRestDomestic(): ?int
    {
        return $this->restDomestic;
    }

    public function setRestDomestic(?int $restDomestic): self
    {
        $this->restDomestic = $restDomestic;

        return $this;
    }

    public function getRestWorldWide(): ?int
    {
        return $this->restWorldWide;
    }

    public function setRestWorldWide(?int $restWorldWide): self
    {
        $this->restWorldWide = $restWorldWide;

        return $this;
    }

    public function getExpressDomestic(): ?int
    {
        return $this->expressDomestic;
    }

    public function setExpressDomestic(?int $expressDomestic): self
    {
        $this->expressDomestic = $expressDomestic;

        return $this;
    }
}
