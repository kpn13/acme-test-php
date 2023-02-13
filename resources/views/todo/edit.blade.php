@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <form action="{{ route('todo.update', $todo->id ) }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="checkbox" aria-label="..." name="checked" id="todo-checked" @checked(old('checked', $todo->checked)) />
                        </span>
                        <input type="text" class="form-control" aria-label="..." name="text" id="todo-text" value="{{ $todo->text }}" />
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Update" />
            </div>
        </form>
    </div>
@endsection
