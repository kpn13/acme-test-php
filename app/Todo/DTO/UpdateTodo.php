<?php

namespace App\Todo\DTO;

class UpdateTodo
{
    public function __construct(
        public readonly string $id,
        public readonly string $text,
        public readonly bool $checked)
    {
    }
}
