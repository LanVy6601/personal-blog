<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Auth::user()->articles;
        return Inertia::render('Admin/Article/Index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return Inertia::render('Admin/Article/Create', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required',
            'tags' => 'nullable'
        ]);
        $article = Article::create([
            'admin_id' => Auth::id(),
            'title' => $data['title'],
            'content' => $data['content'],
            'category_id' => $data['category_id']
        ]);

        if ($data['tags']) {
            $article->tags()->attach($data['tags']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return Inertia::render('Admin/Article/Show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        // if (!Gate::allows('edit-article', $article)) {
        //     abort(403);
        // }
        Gate::authorize('edit-article', $article);
        return Inertia::render('Admin/Article/Edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);
        $article->update([
            'title' => $data['title'],
            'content' => $data['content']
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
    }
}
