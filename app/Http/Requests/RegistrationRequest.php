<?php

namespace App\Http\Requests;

use App\Core\Validator;

class RegistrationRequest extends Request
{
    public function __construct(public array $attributes)
    {
        if (! Validator::string($attributes['username'], 1, 50)) {
            $this->error('username', 'An username of no more than 50 characters is required.');
        }
        if (! Validator::email($attributes['email'])) {
            $this->error('email', 'Not a valid email.');
        }
        if (Validator::emailAlreadyExists($attributes['email'])) {
            $this->error('email', 'Email already exists.');
        }
        if (! Validator::string($attributes['password'], 8, 20)) {
            $this->error('password', 'Use at least 8 characters for password.');
        }
        if (! Validator::passwordConfirm($attributes['password'], $attributes['password_confirm'])) {
            $this->error('password_confirm', "Password confirmation doesn't match.");
        }
    }
}
