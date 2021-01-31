<?php

declare(strict_types=1);

namespace App\Tests\Traits;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Testing\Fakes\MailFake;

trait FakingMailer
{
    /**
     * @beforeScenario
     */
    public function fakeEmail(): void
    {
        app()->bind(Mailer::class, MailFake::class);
    }
}
