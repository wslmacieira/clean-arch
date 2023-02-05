<?php

use App\Application\UseCases\ExportRegistration\ExportRegistration;
use App\Application\UseCases\ExportRegistration\InputBoundary;
use App\Domain\Entities\Registration;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use App\Infra\Adapters\Html2PdfAdapter;
use App\Infra\Adapters\LocalstorageAdapter;
use App\Infra\Repositories\MySQL\PdoRegistrationRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$appConfig = require_once __DIR__ . '/../config/app.php';

$registration = new Registration();
 
$registration->setName('wslmacieira')
    ->setBirthDate(new DateTimeImmutable('1977-12-11'))
    ->setEmail(new Email('wslmacieira@gmail.com'))
    ->setRegistrationAt(new DateTimeImmutable())
    ->setRegistrationNumber(new Cpf('01234567890'));

// Use cases
$dsn = sprintf(
    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
    $appConfig['db']['host'],
    $appConfig['db']['port'],
    $appConfig['db']['dbname'],
    $appConfig['db']['charset']
);

$pdo = new PDO($dsn, $appConfig['db']['username'], $appConfig['db']['password'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT => TRUE
]);

$loadRegistrationRepo = new PdoRegistrationRepository($pdo);

$entity = $loadRegistrationRepo->loadByRegistrationNumber(new Cpf('01234567890'));

echo '<pre>';
print_r($entity);
die;

$pdfExporter = new Html2PdfAdapter();
$storage = new LocalstorageAdapter();

$exportRegistrationUseCase = new ExportRegistration($loadRegistrationRepo, $pdfExporter, $storage);
$inputBoundary = new InputBoundary('01234567890', 'xpto', __DIR__ . '/../storage');
$output = $exportRegistrationUseCase->handle(($inputBoundary));
