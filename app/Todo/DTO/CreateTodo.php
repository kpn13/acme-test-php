<?php

namespace App\Todo\DTO;

class CreateTodo
{
    public function __construct(
        public readonly string $text,
        public readonly bool $checked)
    {
    }
}
