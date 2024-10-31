<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::with('user')->paginate(15);
        return response()->json($articles, 200);
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->all());
        return response()->json(['message' => 'Article created successfully.', 'article' => $article], 201);
    }

    public function update(ArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return response()->json(['message' => 'Article updated successfully.'], 200);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return response()->json(['message' => 'Article deleted successfully.'], 200);
    }

    public function show($id)
    {
        $article = Article::with('user')->find($id);
        return response()->json($article, 200);
    }

}
