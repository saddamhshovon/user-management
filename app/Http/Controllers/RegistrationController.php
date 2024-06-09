<?php

namespace App\Http\Controllers;

use App\Core\App;
use App\Core\Session;
use App\Core\Database;
use App\Core\Authenticator;
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
            $user = $this->db->query(
                'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)',
                [
                    ':username' => $attributes['username'],
                    ':email' => $attributes['email'],
                    ':password' => password_hash('password', PASSWORD_BCRYPT),
                ]
            );

            (new Authenticator)->login(['email' => $$attributes['email']]);

            redirect('/users');
        } catch (\Throwable $th) {
            abort(500, ['message' => $th->getMessage()]);
        }

    }
}
