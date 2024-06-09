<?php

namespace App\Core;

class Validator
{
    public static function string($value, $min = 1, $max = INF)
    {
        $value = trim($value);

        return strlen($value) >= $min && strlen($value) <= $max;
    }

    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    public static function emailAlreadyExists(string $value, $id = null): bool
    {
        $db = App::resolve(Database::class);
        if (! $id) {
            $count = $db->query('SELECT COUNT(*) AS count FROM users WHERE email = :email', [':email' => $value])->find();
        } else {
            $user = $db->query('SELECT email FROM users WHERE id = :id', [':id' => $id])->find();
            $count = $db->query(
                'SELECT COUNT(*) AS count FROM users WHERE email = :email AND email != :current',
                [':email' => $value, ':current' => $user['email']]
            )->find();
        }

        return $count['count'] >= 1;
    }

    public static function in(string $value, array $in): bool
    {
        return in_array($value, $in, true);
    }

    public static function gt(int $value, int $greaterThan): bool
    {
        return $value > $greaterThan;
    }
}
