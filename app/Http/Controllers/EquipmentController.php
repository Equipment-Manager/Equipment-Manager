<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Helpers\ApiResponse;
use App\Services\PermissionsService;
use Illuminate\Contracts\Translation\Translator;

class EquipmentController extends ApiController
{
    protected PermissionsService $permissionsService;
    protected Translator $translator;

    public function __construct(ApiResponse $apiResponse, PermissionsService $permissionsService, Translator $translator)
    {
        parent::__construct($apiResponse);
        $this->permissionsService = $permissionsService;
        $this->translator = $translator;
    }

}
