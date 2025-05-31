<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::paginate();

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles'));
    }

    public function show($id)
    {  
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }

    public function create()
    {
        $article = new Article();
        return view('article.create', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:articles',
            'body' => 'required|min:10',
        ]);

        $article = new Article();
        $article->fill($data);
        $article->save();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Статья успешно создана!');
    }   

    public function edit($id)
    {  
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->validated());

        return redirect()->route('articles.index')->with('success', 'Статья обновлена');
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if ($article) {
            $article->delete();
            session()->flash('success', 'Статья успешно удалена');
        }

        return redirect()->route('articles.index');
    }
}
