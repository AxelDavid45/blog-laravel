@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Create a post</h3>
                    </div>
                    <div class="card-body">
                        @if(session('status'))
                            <div class="alert alert-info">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form
                            action="{{ route('posts.store') }}"
                            method="POST"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            <div class="form-group">
                                <label for="title">Titulo</label>
                                <input required type="text" name="title" class="form-control">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Upload
                                    </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input">
                                    <label class="custom-file-label"
                                           for="image">
                                        Choose an image (optional)
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="body">Post Content</label>
                                <textarea required name="body" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="iframe">Embedded content</label>
                                <textarea name="iframe" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Save" class="float-right btn
                                btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
