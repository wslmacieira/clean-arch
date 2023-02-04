<?php

use App\Application\UseCases\ExportRegistration\ExportRegistration;
use App\Application\UseCases\ExportRegistration\InputBoundary;
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

// Use cases

$loadRegistrationRepo = new stdClass();
$pdfExporter = new stdClass();
$storage = new stdClass();

$exportRegistrationUseCase = new ExportRegistration($loadRegistrationRepo, $pdfExporter, $storage);
$inputBoundary = new InputBoundary('01234567890', 'xpto', __DIR__ . '/../storage');
$output = $exportRegistrationUseCase->handle(($inputBoundary));
