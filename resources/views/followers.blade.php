@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-6">
            <followers-page
                :userid="{{ $userId }}">
            </followers-page>
        </div>
    </div>
@endsection