<?php

namespace App\Core;

class Authenticator
{
    public function attempt($email, $password): bool
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
                'email' => $email,
            ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email,
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}
