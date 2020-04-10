@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach($posts as $post)
                    <div class="card mb-4">
                        <div class="card-header bg-dark align-content-center">
                            <h5 class="card-title text-light m-auto">😋{{ $post->title }}</h5>
                        </div>
                        @if ($post->image)
                            <img class="card-img-top" src="{{ $post->get_image }}" alt="">
                        @elseif($post->iframe)
                            <div class="embed-responsive embed-responsive-16by9">
                                {!! $post->iframe !!}
                            </div>
                        @endif
                        <div class="card-body bg-light">
                            <p class="card-text">
                                {{ $post->get_excerpt }}
                            </p>
                            <a href="{{ route('posts.single', ['slug' => $post->slug]) }}">Read
                                more</a>
                            <p class="text-muted mb-0">
                                <em>
                                    &ndash; {{ $post->user->name }}
                                </em>
                                {{ $post->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="row justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
