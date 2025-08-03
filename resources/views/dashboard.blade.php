<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-1">Welcome back, !</h4>
                            <p class="card-text mb-0">Here's what's happening with your articles today.</p>
                        </div>
                        <div class="text-end">
                            <h2 class="mb-0"></h2>
                            <small>Total Articles</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-journal-text text-primary display-4"></i>
                    <h5 class="mt-3"></h5>
                    <p class="text-muted mb-0">Published</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-eye text-success display-4"></i>
                    <h5 class="mt-3"></h5>
                    <p class="text-muted mb-0">Total Views</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-heart text-danger display-4"></i>
                    <h5 class="mt-3"></h5>
                    <p class="text-muted mb-0">Total Likes</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-calendar text-info display-4"></i>
                    <h5 class="mt-3"></h5>
                    <p class="text-muted mb-0">This Month</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Articles -->
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recent Articles</h5>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>New Article
                    </a>
                </div>
                <div class="card-body">
                    @forelse($recentArticles ?? [] as $article)
                        <div class="d-flex align-items-center py-3 border-bottom">
                            <div class="flex-shrink-0">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-file-text text-muted"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"></h6>
                                <p class="text-muted mb-0 small"></p>
                                <small class="text-muted"></small>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="" class="btn btn-outline-primary btn-sm">View</a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4">
                            <i class="bi bi-journal-text display-4 text-muted"></i>
                            <h5 class="mt-3">No Articles Yet</h5>
                            <p class="text-muted">Start writing your first article!</p>
                            <a href="{{ route('articles.create') }}" class="btn btn-primary">Create Article</a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>New Article
                        </a>
                        <a href="" class="btn btn-outline-secondary">
                            <i class="bi bi-list me-2"></i>All Articles
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="bi bi-gear me-2"></i>Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
