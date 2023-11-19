{{-- 
    This view extends the 'layouts.app' layout file and defines the title and
    content sections. It displays the list of tasks by iterating over the
    `$tasks` collection. If there are no tasks, it displays a message stating
    that there are no tasks available.
--}}

@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
    {{-- @if (count($tasks)) --}}
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse
    {{-- @endif --}}
@endsection
