<?php

namespace App\Todo\Amazon;

use App\Todo\DTO\CreateTodo;
use App\Todo\DTO\UpdateTodo;
use App\Todo\Models\Todo;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AmazonClient implements AmazonClientInterface
{
    public function createTodo(CreateTodo $createTodo): Todo
    {
        $response = Http::post('https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev/todos', [
            'text' => $createTodo->text,
            'checked' => $createTodo->checked,
        ]);

        if (! $response->successful()) {
            Log::error('Unable to create todo', [
                'response' => $response->body(),
            ]);
            throw new \Exception('Unable to create todo');
        }

        $todo = $response->json();

        return new Todo(
            $todo['id'],
            $todo['text'],
            $todo['checked'],
            Carbon::createFromTimestampMsUTC($todo['createdAt']),
            Carbon::createFromTimestampMsUTC($todo['updatedAt']),
        );
    }

    public function getTodos(): Collection
    {
        $response = Http::get('https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev/todos');

        if (! $response->successful()) {
            Log::error('Unable to get todos', [
                'response' => $response->body(),
            ]);
            throw new \Exception('Unable to get todos');
        }

        $content = $response->json();
        $todos = [];

        if (! $content) {
            return collect();
        }

        foreach ($content as $todo) {
            $todos[] = new Todo(
                $todo['id'],
                $todo['text'],
                $todo['checked'],
                Carbon::createFromTimestampMsUTC($todo['createdAt']),
                Carbon::createFromTimestampMsUTC($todo['updatedAt']),
            );
        }

        return collect($todos);
    }

    public function getTodoById(string $id): Todo
    {
        $response = Http::get('https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev/todos/'.$id);

        if (! $response->successful()) {
            Log::error('Unable to get todo by id', [
                'response' => $response->body(),
            ]);
            throw new \Exception('Unable to get todo by id');
        }

        $todo = $response->json();

        return new Todo(
            $todo['id'],
            $todo['text'],
            $todo['checked'],
            Carbon::createFromTimestampMsUTC($todo['createdAt']),
            Carbon::createFromTimestampMsUTC($todo['updatedAt']),
        );
    }

    public function updateTodo(UpdateTodo $updateTodo): Todo
    {
        $response = Http::put('https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev/todos/'.$updateTodo->id, [
            'text' => $updateTodo->text,
            'checked' => $updateTodo->checked,
        ]);

        if (! $response->successful()) {
            Log::error('Unable to update todo', [
                'response' => $response->body(),
            ]);
            throw new \Exception('Unable to update todo');
        }

        $todo = $response->json();

        return new Todo(
            $todo['id'],
            $todo['text'],
            $todo['checked'],
            Carbon::createFromTimestampMsUTC($todo['createdAt']),
            Carbon::createFromTimestampMsUTC($todo['updatedAt']),
        );
    }

    public function deleteTodo(string $id): void
    {
        $response = Http::delete('https://arfkcpx7m7.execute-api.us-east-1.amazonaws.com/dev/todos/'.$id);

        if (! $response->successful()) {
            Log::error('Unable to delete todo', [
                'response' => $response->body(),
            ]);
            throw new \Exception('Unable to delete todo');
        }
    }
}
