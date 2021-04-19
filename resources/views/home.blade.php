@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Check sesion status, if not null, show status -->
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row justify-content-center">

        <!-- Nav Sidebar -->
        <home-sidebar></home-sidebar>

        <!-- Timeline -->
        <home-timeline></home-timeline>
        
        <!-- Friends List and Groups Sidebar -->
        <friends-list></friends-list>

        
    </div>
</div>
@endsection
