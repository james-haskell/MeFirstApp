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
        <home-sidebar
            :userid="{{ $userId }}">
        </home-sidebar>

        <!-- Timeline -->
        <home-timeline></home-timeline>
        
        <!-- Top Ten List and Groups Sidebar -->
        <topten-list 
            :userid="{{ $userId }}">
        </topten-list>

        
    </div>
</div>
@endsection
