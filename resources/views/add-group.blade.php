@extends('layouts.app')
@section('content')
    <div class="container">
        <add-group-form
            :userid="{{ $userId }}">
        </add-group-form>
    </div>
@endsection