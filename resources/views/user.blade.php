@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"><hr></div>
            <div class="col-md-6">
                {{-- User profile --}}
                {{-- <div>
                    -- Header Images --
                    <img src="https://image.shutterstock.com/image-photo/silhouette-palm-trees-sunset-vintage-600w-415974139.jpg"
                        class="cover-photo">
                </div> --}}
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
            <div class="col-md-3"><hr></div>
        </div>
    </div>
@endsection