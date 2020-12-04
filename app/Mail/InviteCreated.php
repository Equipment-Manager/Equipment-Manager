<?php

namespace App\Mail;

use App\Models\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Invite $invite */
    public $invite;

    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    public function build(): self
    {
        return $this->markdown('emails.invite')->subject("Invitation to " . config("app.name"));
    }
}
