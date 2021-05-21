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

        <!-- Timeline -->
        <home-timeline></home-timeline>
        
        <!-- Top Ten List and Groups Sidebar -->
        

        
    </div>
</div>
@endsection
