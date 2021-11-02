@extends('layouts.app')
@section('content')
    <user-timeline
        :follow-route="'{{ route('user.follow', $user) }}'"
        :is-following="{{ $isFollowing }}"
        :is-not="{{ $isNot }}"
        :unfollow-route="'{{ route('user.unfollow', $user) }}'"
        :user="{{ $user }}"
    >
    </user-timeline>
@endsection