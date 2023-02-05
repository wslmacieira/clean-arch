<?php

declare(strict_types=1);

namespace App\Domain\Exceptions;
use App\Domain\ValueObjects\Cpf;
use Exception;
use Throwable;

class RegistrationNotFoundException extends Exception
{
    public function __construct(Cpf $cpf, $code = 0, Throwable $previous = null) {
    $message = "Inscrição com o CPF '{$cpf}' não encotrado";
    parent::__construct($message, $code, $previous);
    }
}
