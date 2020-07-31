<?php declare(strict_types=1);

namespace App\DTO;

class User
{
    private int $id;
    private string $balance;

    /**
     * @param int    $id
     * @param string $balance
     */
    public function __construct(int $id, string $balance)
    {
        $this->id      = $id;
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getBalance(): string
    {
        return $this->balance;
    }
}
