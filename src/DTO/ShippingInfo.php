<?php declare(strict_types=1);

namespace App\DTO;

class ShippingInfo
{
    private string $country;
    private string $city;
    private string $address;
    private string $phone;
    private string $name;
    private ?string $region;
    private ?string $state;
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

    /**
     * @Constraints\NotBlank()
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @Constraints\NotBlank()
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @Constraints\NotBlank()
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @Constraints\NotBlank()
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getRegion(): ?string
    {
        return $this->region;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }
}
