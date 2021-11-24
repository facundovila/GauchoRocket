<?php

use JetBrains\PhpStorm\NoReturn;

class LogoutController {

    #[NoReturn] public function show() {
        session_destroy();
        header('Location: /home');
        exit();
    }
}