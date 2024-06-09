<?php

namespace App\Http\Controllers;

use App\Core\App;
use App\Core\Session;
use App\Core\Database;
use App\Core\Authenticator;
use App\Http\Requests\LoginRequest;

class AuthenticationController
{
    private Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }
    
    public function view()
    {
        return view('auth/login', [
            'errors' => Session::get('errors'),
        ]);
    }

    public function login()
    {
        $request = LoginRequest::validate($attributes = [
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        $signedIn = (new Authenticator)->attempt(
            $attributes['email'], $attributes['password']
        );

        if (! $signedIn) {
            $request->error(
                'email', 'No matching account found for that email address and password.'
            )->throw();
        }

        redirect('/users');
    }

    public function logout()
    {
        (new Authenticator)->logout();

        redirect('/');
    }
}
