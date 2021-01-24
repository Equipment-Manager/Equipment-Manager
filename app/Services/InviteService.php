<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\InviteCreated;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;

class InviteService
{
    protected Hasher $hasher;
    protected Mailer $mailer;

    public function __construct(Hasher $hasher, Mailer $mailer)
    {
        $this->hasher = $hasher;
        $this->mailer = $mailer;
    }

    public function invite(array $data): void
    {
        $invite = Invite::create([
            "email" => $data["email"],
            "token" => Str::uuid(),
            "status" => Invite::STATUS_PENDING,
        ]);

        $this->mailer->to($data["email"])->send(new InviteCreated($invite));
    }

    public function accept(string $token, array $data): User
    {
        $invite = $this->getInviteByToken($token);

        $user = User::create([
            "email" => $invite->email,
            "name" => $data["name"],
            "password" => $this->hasher->make($data["password"]),
        ]);

        $invite->status = Invite::STATUS_ACCEPTED;
        $invite->save();

        return $user;
    }

    public function cancel(string $token): void
    {
        $invite = $this->getInviteByToken($token);

        $invite->status = Invite::STATUS_CANCELED;
        $invite->save();
    }

    /**
     * @throws ModelNotFoundException
     */
    private function getInviteByToken(string $token): Invite
    {
        return Invite::query()
            ->where("token", $token)
            ->pending()
            ->firstOrFail();
    }
}
