@extends('layouts.app')

@section('content')
    @if (count($todos) > 0)
        <div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('todo.store') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" aria-label="..." name="checked" id="todo-checked" />
                        </span>
                            <input type="text" class="form-control" aria-label="..." name="text" id="todo-text" />
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Add todo" />
                </div>
            </form>
            <table class="table table-striped">
                <thead>
                <th>Todo</th>
                <th>Checked</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                </thead>

                <tbody>
                @foreach ($todos->sortByDesc('updatedAt') as $todo)
                    <tr>
                        <td class="table-text">
                            <div>{{ $todo->text }}</div>
                        </td>
                        <td class="table-checked">
                            <div>{{ $todo->checked ? "done" : "" }}</div>
                        </td>

                        <td class="table-createdAt">
                            <div>{{ Carbon\Carbon::parse($todo->createdAt)->setTimezone("Europe/Paris")->format('m-d-Y H:i') }}</div>
                        </td>

                        <td class="table-updatedAt">
                            <div>{{ Carbon\Carbon::parse($todo->updatedAt)->setTimezone("Europe/Paris")->format('m-d-Y H:i') }}</div>
                        </td>

                        <td>
                            <form action="{{ url('todos/'.$todo->id.'/edit') }}" method="GET">
                                <button type="submit" class="btn">
                                    <i class="fa fa-trash"></i> Edit
                                </button>
                            </form>
                        </td>

                        <td>
                            <form action="{{ url('todos/'.$todo->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
