<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth")->except(["index", "detail"]);
    }

    public function index()
    {
        $data = Article::latest()->paginate(5);

        return view("articles.index", ['articles' => $data]);
    }

    public function detail($id)
    {
        $data = Article::find($id);

        return view("articles.detail", ['article' => $data]);
    }

    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows("delete-article", $article)) {
            $article->delete();

            return redirect("/articles")->with("info", "Article Deleted");
        }

        return back("/articles")->with("info", "Unauthorized");
    }

    public function add()
    {
        return view("articles.add");
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("/articles");
    }

    public function update(Article $article)
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->update();

        return redirect("/articles/detail/$article->id")->with('info', "Successfully edited!");
    }

    public function edit(Article  $article): View
    {
        return view('articles.edit', ['article' => $article]);
    }
}
