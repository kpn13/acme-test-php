<?php

namespace App\Todo\Amazon;

use App\Todo\DTO\CreateTodo;
use App\Todo\DTO\UpdateTodo;
use App\Todo\Models\Todo;
use Illuminate\Support\Collection;

interface AmazonClientInterface
{
    public function createTodo(CreateTodo $createTodo): Todo;

    public function getTodos(): Collection;

    public function getTodoById(string $id): Todo;

    public function updateTodo(UpdateTodo $updateTodo): Todo;

    public function deleteTodo(string $id): void;
}
