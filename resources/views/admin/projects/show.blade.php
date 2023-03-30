@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Project Details') }}</div>

                    <div class="card-body">
                        <h4 class="card-title">{{ $project->title }}</h4>
                        <p class="card-text">{{ $project->description }}</p>
                        <p class="card-text"><small class="text-muted">{{ __('Created on') }} {{ $project->created_at->format('d/m/Y H:i:s') }}</small></p>
                        <img src="{{ asset('storage/' . $project->image) }}" alt="Project image">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
