<?php

declare(strict_types=1);

namespace App\Application\Interfaces;

use App\Domain\Entities\Registration;

interface ExportRegistrationPdfExporter
{
  public function generate(Registration $registration): string;
}

