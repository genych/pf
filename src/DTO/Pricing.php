<?php declare(strict_types=1);

namespace App\DTO;

class Pricing
{
    private string $firstDomestic;
    private string $firstWorldwide;
    private string $restDomestic;
    private string $restWorldWide;
    private string $expressDomestic;

    /**
     * @param string $firstDomestic
     * @param string $firstWorldwide
     * @param string $restDomestic
     * @param string $restWorldWide
     * @param string $expressDomestic
     */
    public function __construct(
        string $firstDomestic,
        string $firstWorldwide,
        string $restDomestic,
        string $restWorldWide,
        string $expressDomestic
    ) {
        $this->firstDomestic   = $firstDomestic;
        $this->firstWorldwide  = $firstWorldwide;
        $this->restDomestic    = $restDomestic;
        $this->restWorldWide   = $restWorldWide;
        $this->expressDomestic = $expressDomestic;
    }

    /**
     * @return string
     */
    public function getFirstDomestic(): string
    {
        return $this->firstDomestic;
    }

    /**
     * @return string
     */
    public function getFirstWorldwide(): string
    {
        return $this->firstWorldwide;
    }

    /**
     * @return string
     */
    public function getRestDomestic(): string
    {
        return $this->restDomestic;
    }

    /**
     * @return string
     */
    public function getRestWorldWide(): string
    {
        return $this->restWorldWide;
    }

    /**
     * @return string
     */
    public function getExpressDomestic(): string
    {
        return $this->expressDomestic;
    }
}
