<?php declare(strict_types=1);

namespace App\Validator;

use App\DTO\IncomingOrder;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Order
{
    /** @var ValidatorInterface */
    private ValidatorInterface $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(IncomingOrder $order): IncomingOrder
    {
        
    }
}
