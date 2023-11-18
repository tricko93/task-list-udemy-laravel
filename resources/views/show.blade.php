{{-- 
	This view extends the 'layouts.app' layout file and defines the title
	and content sections. It displays the details of a single task,
	including the title, description, optional long description, and
	creation/update timestamps.
--}}

@extends('layouts.app')

@section('title', $task->title)

@section('content')
<p>{{ $task->description }}</p>

@if($task->long_description)
	<p>{{ $task->long_description }}</p>
@endif

<p>{{ $task->created_at }}</p>
<p>{{ $task->updated_at }}</p>
@endsection