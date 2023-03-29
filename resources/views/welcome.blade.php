@extends('layouts.app')
@section('content')

   <div class="container-fluid py-5 bg-light">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center">
                <div>
                    <h1>Welcome to Project Portfolio!</h1>
                    <p class="lead mb-4">Showcase your projects and connect with other professionals.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg mr-3">Get Started</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">Log In</a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/portfolio.png') }}" alt="Portfolio Image" class="img-fluid">
            </div>
        </div>
    </div>
@endsection