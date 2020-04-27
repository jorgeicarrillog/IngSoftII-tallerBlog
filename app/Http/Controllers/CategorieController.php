<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Categorie;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Categorie::paginate(10);   

        return view('categorie.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.create');
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
        ]);

        $post = new Categorie();
        $post->fill($request->all());
        $post->url_clean = Str::of($request->title)->slug('-');
        if ($post->save()) {
            return redirect()->route('categorie.index',$post->url_clean);
        }else{
            return redirect()->back()->withErrors(['Ocurrio algo intentalo de nuevo.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Categorie::find($id);
        if (!empty($post)) {
            return view('categorie.edit')->withPost($post);
        }
        return redirect()->route('categorie.index');
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
        $post = Categorie::find($id);
        if (!empty($post) && $post->title!=$request->title) {
            $validatedData = $request->validate([
                'title' => 'required',
            ]);

            $post->fill($request->all());
            $post->url_clean = Str::of($request->title)->slug('-');
            if ($post->save()) {
                return redirect()->route('categorie.index');
            }else{
                return redirect()->back()->withErrors(['Ocurrio algo intentalo de nuevo.']);
            }
        }
        return redirect()->route('categorie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Categorie::find($id);
        if (!empty($cat)) {
            if ($cat->posts()->count()>0) {
                return redirect()->back()->with(['error'=>'La categoria esta siendo utilizada, no se puede eiminar']);
            }
            $cat->delete();
        }
        return redirect()->route('categorie.index');
    }
}
