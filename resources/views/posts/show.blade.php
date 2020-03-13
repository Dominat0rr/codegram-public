@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <img class="w-100" src="/storage/{{ $post->image }}" alt="">
            </div>

            <div class="col-md-4">
                <div>
                    <div class="d-flex align-items-center">
                        <div class="pr-3">
                            <img class="rounded-circle w-100" src="{{ $post->user->profile->profileImage() }}" alt="" style="max-width:40px;">
                        </div>
                        <div>
                            <div class="font-weight-bold">
                                <a href="/profile/{{ $post->user->id }}">
                                    <span class="text-dark">{{ $post->user->username }}</span>
                                </a> |
                                <a class="pl-2" href="#">Follow</a>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <p>
                        <span class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                        </span> {{ $post->caption }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
