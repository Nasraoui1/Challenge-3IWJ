<?php

namespace App\Forms;

class Register {
    public static function getConfig() {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/register",
                "submit" => "Register",
                "enctype" => ""
            ],
            "inputs" => [
                "firstname" => [
                    "type" => "text",
                    "label" => "First Name",
                    "required" => true,
                    "min" => 2,
                    "max" => 255,
                    "error" => "The first name should be between 2 and 255 characters"
                ],
                "lastname" => [
                    "type" => "text",
                    "label" => "Last Name",
                    "required" => true,
                    "min" => 2,
                    "max" => 255,
                    "error" => "The last name should be between 2 and 255 characters"
                ],
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
                    "error" => "The password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number"
                ],
                "confirm_password" => [
                    "type" => "password",
                    "label" => "Confirm Password",
                    "required" => true,
                    "confirm" => "password",
                    "error" => "The passwords do not match"
                ],
                "birthday" => [
                    "type" => "date",
                    "label" => "Birthday",
                    "required" => false,
                    "error" => "The birthday format is incorrect"
                ]
            ]
        ];
    }
}
