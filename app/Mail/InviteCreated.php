<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * @var Invite
     */
    public $invite;

    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    public function build(): self
    {
        return $this->markdown("emails.invite")->subject("Invitation to " . config("app.name"));
    }
}
