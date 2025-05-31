<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }

    public function create()
    {
        return view('article.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5'],
            'body' => ['required', 'min:100'],
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Статья создана');
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5'],
            'body' => ['required', 'min:100'],
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Статья обновлена');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена');
    }
}
