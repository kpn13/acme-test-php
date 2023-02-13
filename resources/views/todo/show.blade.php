@extends('layouts.app')

@section('content')
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <thead>
                    <th>Todo</th>
                    <th>&nbsp;</th>
                    </thead>

                    <tbody>
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <div>{{ $todo->text }}</div>
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
                    </tbody>
                </table>
            </div>
        </div>
@endsection
