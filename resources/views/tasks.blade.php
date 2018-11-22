@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                <h1>Create Task</h1>

                <form method="post" action="{{ url('/tasks') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea type="text" class="form-control" name="description" placeholder="Description" maxlength="255"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Task</button>
                </form>

                <table class="table">
                    <thead>
                    <tr class="d-flex">
                        <th class="col-3">Title</th>
                        <th class="col-9">Description</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $task)
                        <tr class="d-flex">
                            <td class="col-3"><a href="{{ route('comments', $task->id) }}">{{ $task->title }}</a></td>
                            <td class="col-9">{{ $task->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
