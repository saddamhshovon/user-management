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
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role'],
                ]);

                return true;
            }
        }

        return false;
    }

    public function login($user): void
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'],
        ];

        session_regenerate_id(true);
    }

    public function logout(): void
    {
        Session::destroy();
    }
}
