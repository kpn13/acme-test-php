<?php

namespace App\Todo\Models;

use Carbon\Carbon;

class Todo
{
    public function __construct(
        public readonly string $id,
        public readonly string $text,
        public readonly bool $checked,
        public readonly Carbon $createdAt,
        public readonly Carbon $updatedAt)
    {
    }
}
