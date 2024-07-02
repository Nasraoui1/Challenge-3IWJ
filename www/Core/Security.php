<?php

namespace App\Core;

class Security {
    public static function login($userId) {
        $_SESSION['user_id'] = $userId;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function logout() {
        session_destroy();
    }
}
