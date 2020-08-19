<?php

namespace App\Http\Controllers;

use App\{Category, Tag, Post};
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::inRandomOrder()->paginate(6);
        return view('post/index', compact('posts'));
    }

    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('post/show', compact('post', 'posts'));
    }
    public function create()
    {
        return view('post/create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function store(PostRequest $request)
    {
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        $attr = $request->all();

        $slug = Str::slug(request('title'));
        $attr['slug'] =  $slug;

        $thumbnail = request()->file('thumbnail') ? request()->file('thumbnail')->store("image/posts") : null;

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        // create new post
        $post = auth()->user()->posts()->create($attr);
        $post->tags()->attach(request('tags'));
        session()->flash('success', 'Berhasil Menambahkan Data');

        return redirect()->to(route('posts.index'));
    }

    public function edit(Post $post)
    {
        return view('post/edit', [
            'post' => $post,
            'categories' => Category::get(),
            'tags' => Tag::get()
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);
        $this->authorize('update', $post);

        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("image/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }


        $attr = $request->all();
        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post->update($attr);
        $post->tags()->sync(request('tags'));
        session()->flash('success', 'Berhasil Mengupdate Data');

        return redirect()->to('post');
    }
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();

        session()->flash("success", 'Berhasil Menghapus Data');
        return redirect('post');
    }
}
