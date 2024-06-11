<?php

namespace App\Http\Requests;

use App\Core\Exceptions\ValidationException;

class Request
{
    protected array $errors = [];

    public function __construct(public array $attributes, $id = null)
    {
    }

    public static function validate(array $attributes, $id = null)
    {
        $instance = new static($attributes, $id);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    public function throw(): never
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed(): int
    {
        return count($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function error($field, $message): static
    {
        $this->errors[$field] = $message;

        return $this;
    }
}
