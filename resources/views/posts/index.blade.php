@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">
                            Manage Posts
                            <a href="{{route('posts.create')}}"
                               class="float-right btn btn-outline-primary btn-sm">
                                New Post <i class="fas fa-plus-circle"></i>
                            </a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <td>ID</td>
                                <td>Title</td>
                                <td colspan="2">Actions</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->title }}</td>
                                    <td>
                                        <a
                                            class="btn btn-sm btn-outline-primary"
                                            href="{{ route('posts.edit', $post) }}">
                                            <i class="fas fa-pen"></i> Modify
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST"
                                              action="{{ route('posts.destroy', $post) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm
                                            btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to ' +
                                             'delete this post?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
