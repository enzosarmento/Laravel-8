<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate();


        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePost $request)
    {
        $data = $request->all();

        if ($request->image->isValid()) {

            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image))
                Storage::delete($post->image);


            $nameFile = Str::of($request->title)->slug('-') . '.' . $request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Post atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$post = Post::find($id)) {
            return redirect()->route('posts.index');
        }

        if (Storage::exists($post->image))
            Storage::delete($post->image);

        $post->delete();
        return redirect()
            ->route('posts.index')
            ->with('message', 'Post deletado com sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "{$request->search}")
            ->paginate();

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
