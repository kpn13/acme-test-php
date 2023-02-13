<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Todo\DTO\CreateTodo;
use App\Todo\DTO\UpdateTodo;
use App\Todo\Service\TodoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

class TodoController extends BaseController
{
    public function __construct(
        private readonly TodoService $todoService,
    ) {
    }

    public function index(): View
    {
        return view('todo.index', [
            'todos' => $this->todoService->getTodos(),
        ]);
    }

    public function show(string $id): View
    {
        return view('todo.show', [
            'todo' => $this->todoService->getTodoById($id),
        ]);
    }

    public function edit(string $id): View
    {
        return view('todo.edit', [
            'todo' => $this->todoService->getTodoById($id),
        ]);
    }

    public function store(CreateTodoRequest $request): RedirectResponse
    {
        $this->todoService->createTodo(new CreateTodo(
            $request->input('text'),
            $request->exists('checked'),
        ));

        return redirect()->route('todo.index');
    }

    public function update(UpdateTodoRequest $request, string $id): RedirectResponse
    {
        $this->todoService->updateTodo(new UpdateTodo(
            $id,
            $request->input('text'),
            $request->exists('checked'),
        ));

        return redirect()->route('todo.index');
    }

    public function delete(string $id): RedirectResponse
    {
        $this->todoService->deleteTodo($id);

        return redirect()->route('todo.index');
    }
}
