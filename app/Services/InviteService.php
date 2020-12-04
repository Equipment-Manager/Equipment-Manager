<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\InviteCreated;
use App\Models\Invite;
use App\Models\User;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InviteService
{
    protected Hasher $hasher;
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }

    public function invite(array $data): void
    {
        do {
            $token = Str::random();
        } while (Invite::query()->where("token", $token)->first());

        $invite = Invite::create([
            "email" => $data["email"],
            "token" => $token,
        ]);

        Mail::to($data["email"])->send(new InviteCreated($invite));
    }

    public function accept(string $token, array $data): User
    {
        if(!$invite = Invite::where("token", $token)->first()) {

        }

        $user = User::create([
            "email" => $invite->email,
            "name" => $data["name"],
            "password" => $this->hasher->make($data["password"]),
        ]);

        $invite->delete();
        return $user;
    }

}