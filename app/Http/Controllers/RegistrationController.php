<?php

namespace App\Http\Controllers;

use App\Core\App;
use App\Core\Authenticator;
use App\Core\Database;
use App\Core\Session;
use App\Http\Requests\RegistrationRequest;

class RegistrationController
{
    private Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function view()
    {
        return view('auth/register', [
            'errors' => Session::get('errors'),
        ]);
    }

    public function register()
    {
        $request = RegistrationRequest::validate($attributes = [
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
        ]);

        try {
            $this->db->query(
                'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)',
                [
                    ':username' => $attributes['username'],
                    ':email' => $attributes['email'],
                    ':password' => password_hash('password', PASSWORD_BCRYPT),
                ]
            );

            $user = $this->db->query(
                'SELECT id, username, email, role FROM users WHERE email = :email',
                [
                    ':email' => $attributes['email'],
                ]
            )->find();

            (new Authenticator)->login($user);

            redirect('/users');
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }

    }
}
