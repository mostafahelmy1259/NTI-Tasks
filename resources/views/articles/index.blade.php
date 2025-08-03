@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Articles</h1>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Create Article
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>the article has been created successfully</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{$article->title}}</h5>
                        <p class="card-text text-muted">
                            {{$article->body}}
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted">
                                By {{$article->user->name}}
                            </small>
                            <div class="btn-group" role="group">
                                <a href="" 
                                   class="btn btn-sm btn-outline-primary">View</a>
                                @can('update', $article)
                                    <a href="" 
                                       class="btn btn-sm btn-outline-secondary">Edit</a>
                                @endcan
                                @can('delete', $article)
                                    <form action="" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-journal-text display-1 text-muted"></i>
                    <h3 class="mt-3">No Articles Yet</h3>
                    <p class="text-muted">Be the first to create an article!</p>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">
                        Create Your First Article
                    </a>
                </div>
            </div>
        @endforelse
    </div>

</div>
@endsection