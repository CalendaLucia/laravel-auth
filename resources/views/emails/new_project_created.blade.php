
@extends('layouts.app')
 @section('content')

	 	<h1>New Project Created</h1>
	<p>Hello {{$user->name}},</p>
	<p>A new project named "{{$project->name}}" has been created successfully.</p>
	<p>Thank you for using our application!</p>
 @endsection