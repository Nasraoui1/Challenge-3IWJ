<?php

namespace App\Forms;

class Login {
    public static function getConfig() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/login",
                "submit" => "Login",
                "enctype" => ""
            ],
            "inputs" => [
                "email" => [
                    "type" => "email",
                    "label" => "Email",
                    "required" => true,
                    "error" => "The email format is incorrect"
                ],
                "password" => [
                    "type" => "password",
                    "label" => "Password",
                    "required" => true,
                    "min" => 8,
                    "error" => "The password must be at least 8 characters long"
                ]
            ]
        ];
    }
}
