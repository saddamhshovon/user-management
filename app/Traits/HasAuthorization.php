<?php
namespace App\Traits;
use App\Enums\Role;

trait HasAuthorization
{
    protected function authorize(array $roles, $id = null)
    {
        if(! in_array($_SESSION['user']['role'], $roles))
        {
            redirect('/users');
        }

        if($id && $_SESSION['user']['role'] == Role::User->value && $_SESSION['user']['id'] != $id)
        {
            redirect('/users');
        }

    }
}
