<?php

namespace App\Todo\Service;

use App\Todo\Amazon\AmazonClientInterface;
use App\Todo\DTO\CreateTodo;
use App\Todo\DTO\UpdateTodo;
use App\Todo\Models\Todo;
use Illuminate\Support\Collection;

class TodoService
{
    public function __construct(
        private readonly AmazonClientInterface $amazonClient,
    ) {
    }

    public function getTodos(): Collection
    {
        return $this->amazonClient->getTodos();
    }

    public function getTodoById(string $id): Todo
    {
        return $this->amazonClient->getTodoById($id);
    }

    public function createTodo(CreateTodo $createTodo): Todo
    {
        return $this->amazonClient->createTodo($createTodo);
    }

    public function updateTodo(UpdateTodo $updateTodo): Todo
    {
        return $this->amazonClient->updateTodo($updateTodo);
    }

    public function deleteTodo(string $id): void
    {
        $this->amazonClient->deleteTodo($id);
    }
}
