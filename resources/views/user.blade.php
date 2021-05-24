@extends('layouts.app')
@section('content')
    <user-timeline
        :user="{{ $user }}"
        :is-not="{{ $isNot }}"
        :is-following="{{ $isFollowing }}"
        :unfollow-route="'{{ route('user.unfollow', $user) }}'"
        :follow-route="'{{ route('user.follow', $user) }}'">
    </user-timeline>
@endsection