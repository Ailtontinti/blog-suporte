<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
         return view('posts.create');
    }

    public function store(Request $request)
    {
        // ... your validation ...
    
        $post = Post::create([
            'title' => $request->title,
            'category' => $request->category,
            'content' => '', // Or any initial content for the post itself
        ]);
    
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $section) {
                if ($section['type'] === 'text' && !empty($section['content'])) {
                    $post->sections()->create([
                        'type' => 'text',
                        'content' => nl2br(e($section['content'])),
                    ]);
                } elseif ($section['type'] === 'media' && $request->hasFile("sections.{$index}.file")) {
                    $file = $request->file("sections.{$index}.file");
                    $path = $file->store('public/posts');
                    $url = Storage::url($path); // Or just save $path
    
                    $post->sections()->create([
                        'type' => 'media',
                        'content' => $url, // Or $path
                    ]);
                }
            }
        }
    
        //dd($request->all()); // Keep this for now for debugging
        return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
    }

    //public function show($id)
    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);
        $post = Post::with('sections')->findOrFail($post->id);        
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,gif,mp4,mov,avi,webp|max:20480',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        if ($request->hasFile('media')) {
            if ($post->media) {
                Storage::delete('public/' . $post->media);
            }

            $post->media = $request->file('media')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('posts.show', $post->id)->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Opcional: se armazenar mídias separadamente
        preg_match_all('/src=[\'"]([^\'"]+)[\'"]/', $post->content, $matches);
        foreach ($matches[1] as $url) {
            $path = str_replace('/storage/', 'public/', $url);
            Storage::delete($path);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deletado com sucesso.');
    }
}
