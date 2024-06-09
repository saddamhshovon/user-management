<?php

namespace App\Http\Requests;

use App\Core\Exceptions\ValidationException;

class Request
{
    protected $errors = [];

    public function __construct(public array $attributes, $id = null)
    {
    }

    public static function validate($attributes, $id = null)
    {
        $instance = new static($attributes, $id);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
