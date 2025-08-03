<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ArticleController extends Controller
{
    // Enable authorization methods (authorize, can, etc.)
    use AuthorizesRequests;

    // Display all articles with their authors
    public function index()
    {
        // Get all articles with their user relationship loaded (eager loading)
        $articles = Article::with('user')->latest()->get();
        return view('articles.index', compact('articles'));
    }

    // Show the create article form
    public function create()
    {
        return view('articles.create');
    }

    // Save a new article
    public function store(Request $request)
    {
        // Validate the form data
        $data = $request->validate([
            'title' => 'required|string|max:255', // Title is required, max 255 characters
            'body' => 'required|string',          // Body is required
        ]);

        // Create article for the current user
        $request->user()->articles()->create($data);

        // Redirect with success message
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }

    // Show the edit article form
    public function edit(Article $article)
    {
        // Check if user can update this article (authorization)
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    // Update an existing article
    public function update(Request $request, Article $article)
    {
        // Check if user can update this article (authorization)
        $this->authorize('update', $article);

        // Validate the form data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the article
        $article->update($data);

        // Redirect with success message
        return redirect()->route('articles.index')->with('success', 'Article updated!');
    }

    // Delete an article
    public function destroy(Article $article)
    {
        // Check if user can delete this article (authorization)
        $this->authorize('delete', $article);
        
        // Delete the article
        $article->delete();

        // Redirect with success message
        return redirect()->route('articles.index')->with('success', 'Article deleted!');
    }
}
