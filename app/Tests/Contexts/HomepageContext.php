<?php

declare(strict_types=1);

namespace App\Tests\Contexts;

use App\Tests\Traits\Requesting;
use Behat\Behat\Context\Context;

class HomepageContext implements Context
{
    use Requesting;
}
