<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'List article posts!',
            'data' => $articles
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'title' =>  'required',
            'body' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->messages(), 422);
        }

        $user =  auth()->user();
        $article = $user->articles()->create([
            'title' =>  $request->title,
            'body' =>  $request->body,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Article added successfully!',
            'data' => $article
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articles = Article::with('comments')->find($id);

        return response()->json([
            'success' => true,
            'message' => 'Article successfully found!',
            'data' => $articles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(),[
            'title' =>  'required',
            'body' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json($validator->messages(), 422);
        }

        // $article = Article::where('id', $id)->update([
        //     'title' =>  $request->title,
        //     'body' =>  $request->body,
        // ]);

        $article = Article::find($id);
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();

        return response()->json([
            'success' => true,
            'message' => 'Article changed successfully!',
            'data' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Article successfully deleted!',
            'data' => $article
        ]);
    }
}
