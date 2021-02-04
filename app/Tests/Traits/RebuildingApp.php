<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use App\Console\Kernel;

trait RebuildingApp
{
    /**
     * @beforeScenario
     */
    public function rebuildApp(): void
    {
        $app = require __DIR__ . "../../../../bootstrap/app.php";
        $app->make(Kernel::class)->bootstrap();
    }
}
