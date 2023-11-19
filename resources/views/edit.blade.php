{{-- 
	This file is a view for editing task using Laravel framework.
	It uses the app layout, custom CSS, and Blade template engine.
--}}

@extends('layouts.app')

@section('content')
	@include('form', ['task' => $task])
@endsection
