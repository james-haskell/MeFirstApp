@extends('layouts.app')
@section('content')
    <div class="container">
        <group-page
            :group-id="{{ $groupId }}"
            :user-id="{{ $userId }}">
        </group-page>
    </div>
@endsection