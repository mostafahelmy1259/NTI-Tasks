@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"></h4>
                    <div class="btn-group" role="group">
                        @can('update', $article)
                            <a href="" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil me-1"></i>Edit
                            </a>
                        @endcan
                        @can('delete', $article)
                            <form action="" 
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this article?')">
                                    <i class="bi bi-trash me-1"></i>Delete
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <small class="text-muted">
                            By  • 
                            
                        </small>
                    </div>
                    
                    <div class="article-content">
                        <!-- {!! nl2br(e($article->body)) !!} -->
                         {{$article->user->body}}
                    </div>
                </div>
                <div class="card-footer">
                    <a href="" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection