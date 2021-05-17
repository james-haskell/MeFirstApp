@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-6">
            <following-page
                :userid="{{ $userId }}">
            </following-page>
        </div>
    </div>
@endsection