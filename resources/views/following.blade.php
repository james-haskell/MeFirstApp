@extends('layouts.app')
@section('content')
    <div class="container">
        <following-page
            :userid="{{ $userId }}">
        </following-page>
    </div>
@endsection