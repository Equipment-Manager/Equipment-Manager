<?php

declare(strict_types=1);

namespace BehatTests;

use Behat\Behat\Context\Context;
use BehatTests\Helpers\Requesting;

class HomepageContext implements Context
{
    use Requesting;
}