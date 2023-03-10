<?php

use App\Application\UseCases\ExportRegistration\ExportRegistration;
use App\Domain\Entities\Registration;
use App\Domain\ValueObjects\Cpf;
use App\Domain\ValueObjects\Email;
use App\Infra\Adapters\DomPdfAdapter;
use App\Infra\Adapters\Html2PdfAdapter;
use App\Infra\Adapters\LocalstorageAdapter;
use App\Infra\Http\Controllers\ExportRegistrationController;
use App\Infra\Presentation\ExportRegistrationPresenter;
use App\Infra\Repositories\MySQL\PdoRegistrationRepository;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

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
// $pdfExporter = new Html2PdfAdapter();
$pdfExporter = new DomPdfAdapter();
$storage = new LocalstorageAdapter();

$exportRegistrationUseCase = new ExportRegistration($loadRegistrationRepo, $pdfExporter, $storage);
$request = new Request('GET', 'http://localhost:3000');
$response = new Response();

//Controllers

$exportRegistrationController = new ExportRegistrationController(
    $request,
    $response,
    $exportRegistrationUseCase
);

$exportRegistrationPresenter = new ExportRegistrationPresenter();

echo $exportRegistrationController->handle($exportRegistrationPresenter)->getBody();
