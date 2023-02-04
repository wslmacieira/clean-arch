<?php

use App\Domain\Entities\Registration;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;

require_once __DIR__ . '/../vendor/autoload.php';

$registration = new Registration();
 
$registration->setName('wslmacieira')
    ->setBirthDate(new DateTimeImmutable('1977-12-11'))
    ->setEmail(new Email('wslmacieira@gmail.com'))
    ->setRegistrationAt(new DateTimeImmutable())
    ->setRegistrationNumber(new Cpf('01234567890'));

echo '<pre>';
print_r($registration);
