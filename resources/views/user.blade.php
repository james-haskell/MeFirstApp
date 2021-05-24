@extends('layouts.app')
@section('content')
    <div class="container">
        Hello
        <user-timeline></user-timeline>

        <h3>{{ $user->name }}</h3>

        {{-- Follow button system --}}
        @if(auth()->user()->isNot($user))
            @if(auth()->user()->isFollowing($user))
                <a href="{{ route('user.unfollow', $user) }}" class="btn btn-danger">Unfollow</a>
            @else
                <a href="{{ route('user.follow', $user) }}" class="btn btn-success">Follow</a>
            @endif
        @endif
    </div>
@endsection