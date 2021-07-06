<?php

declare(strict_types=1);

return [
    "model" => [
        "not_found" => "Model not found",
    ],
    "route" => [
        "not_found" => "Route not found",
    ],
    "errors" => [
        "internal_server_error" => "Internal server error",
    ],
    "auth" => [
        "forbidden" => "You are not allowed to do this action.",
    ],
    "user" => [
        "deactivate" => [
            "fail" => "There was an error while deactivating a user.",
            "success" => "User successfully deactivated.",
        ],
    ],
    "equipment" => [
        "properties" => [
            "not_allowed" => "Provided property is not allowed in this category",
            "wrong_type" => "Provided property does not have a valid type",
        ]
    ]
];
