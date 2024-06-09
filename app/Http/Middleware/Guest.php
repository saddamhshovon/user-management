<?php

namespace App\Http\Middleware;

class Guest
{
    public function handle(): void
    {
        if ($_SESSION['user'] ?? false) {
            redirect('/users');
        }
    }
}
