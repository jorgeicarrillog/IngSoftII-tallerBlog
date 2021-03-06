<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);   

        return view('home')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'posted' => 'required|in:yes,not',
            'categorie_id' => 'required|exists:App\Categorie,id',
        ]);

        $post = new Post();
        $post->fill($request->all());
        $post->user_id = auth()->id();
        $post->url_clean = Str::of($request->title)->slug('-');
        if ($post->save()) {
            return redirect()->route('posts.show',$post->url_clean);
        }else{
            return redirect()->back()->withErrors(['Ocurrio algo intentalo de nuevo.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $post = Post::where('url_clean', $url)->first();
        if (!empty($post)) {
            return view('post')->withPost($post);
        }
        return redirect()->route('welcome');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (!empty($post)) {
            return view('admin.edit')->withPost($post);
        }
        return redirect()->route('home');
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
        $post = Post::find($id);
        if (!empty($post)) {
            $validatedData = $request->validate([
                'content' => 'required',
                'posted' => 'required|in:yes,not',
                'categorie_id' => 'required|exists:App\Categorie,id',
            ]);

            $post->fill($request->all());
            if ($post->save()) {
                return redirect()->route('posts.show',$post->url_clean);
            }else{
                return redirect()->back()->withErrors(['Ocurrio algo intentalo de nuevo.']);
            }
        }
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!empty($post)) {
            $post->delete();
        }
        return redirect()->route('home');
    }
}
