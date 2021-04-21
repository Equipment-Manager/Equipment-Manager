<?php

declare(strict_types=1);

namespace App\Http\Helpers;

abstract class Permissions
{
    public const MANAGE_USERS = "Manage users";
    public const MANAGE_PERMISSIONS = "Manage permissions";
    public const MANAGE_INVITES = "Manage invites";
}
