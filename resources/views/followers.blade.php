@extends('layouts.app')
@section('content')
    <div class="container">
        <followers-page
            :userid="{{ $userId }}">
        </followers-page>
    </div>
@endsection