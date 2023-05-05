<?php

namespace App\Auth;
class Security {
    public function login(): void
    {
        echo "Login";
    }
}

namespace App\Core;
class Security {
    public function hashPwd(String $pwd): String
    {
        return password_hash($pwd, PASSWORD_DEFAULT);
    }
}


use App\Auth\Security as secuAuth;
use App\Core\Security as secuCore;

$secu1 = new secuAuth();
$secu2 = new secuAuth();
$secu3 = new secuAuth();
$secu4 = new secuAuth();
$secu->login();


















