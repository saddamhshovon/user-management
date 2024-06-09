<?php

namespace App\Http\Requests;

use App\Core\Validator;
use App\Enums\Role;

class UserUpdateRequest extends Request
{
    public function __construct(public array $attributes, $id)
    {
        parent::__construct($attributes, $id);

        if (! Validator::string($attributes['username'], 1, 50)) {
            $this->error('username', 'An username of no more than 50 characters is required.');
        }
        if (! Validator::email($attributes['email'])) {
            $this->error('email', 'Not a valid email.');
        }
        if (Validator::emailAlreadyExists($attributes['email'], $id)) {
            $this->error('email', 'Email already exists.');
        }
        if (! Validator::in($attributes['role'], Role::values())) {
            $this->error('role', 'Role should be between Moderator and User.');
        }
    }
}
