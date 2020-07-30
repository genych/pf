<?php

namespace App\Entity;

use App\Repository\ShippingInfoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ShippingInfoRepository::class)
 */
class ShippingInfo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $country;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $phone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $state;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $zip;

    /**
     * @param string $country
     * @param string $city
     * @param string $address
     * @param string $phone
     * @param string $name
     * @param string|null $region
     * @param string|null $state
     * @param string|null $zip
     */
    public function __construct(
        string $country,
        string $city,
        string $address,
        string $phone,
        string $name,
        ?string $region,
        ?string $state,
        ?string $zip
    ) {
        $this->country = $country;
        $this->city    = $city;
        $this->address = $address;
        $this->phone   = $phone;
        $this->name    = $name;
        $this->region  = $region;
        $this->state   = $state;
        $this->zip     = $zip;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getZip(): ?string
    {
        return $this->zip;
    }
}
