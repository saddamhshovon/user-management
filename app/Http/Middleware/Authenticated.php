<?php

namespace App\Http\Middleware;

class Authenticated
{
    public function handle(): void
    {
        if (! $_SESSION['user'] ?? false) {
            header('location: /');
            exit();
        }
    }
}
