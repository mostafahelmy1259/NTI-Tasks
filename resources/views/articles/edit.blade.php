@extends('layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h4 class="mb-0">Edit Article</h4>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="" required>
                            @error('title')
                                <div class="invalid-feedback"></div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body" class="form-label">Content</label>
                            <textarea class="form-control @error('body') is-invalid @enderror" 
                                      id="body" name="body" rows="8" required></textarea>
                            @error('body')
                                <div class="invalid-feedback"></div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Update Article
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection