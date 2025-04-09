<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

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
    $request->validate([
        'title' => 'required|string|max:255',
        'category' => 'required|string',
        'sections' => 'required|array',
        'sections.*.type' => 'required|string|in:text,media',
        'sections.*.content' => 'required_if:sections.*.type,text|string|nullable',
        'sections.*.file' => 'required_if:sections.*.type,media|file|mimes:jpeg,png,jpg,gif,webp,mp4,webm|max:20480',
    ]);

    $post = Post::create([
        'title' => $request->title,
        'category' => $request->category,
        'content' => '', // Você pode deixar isso vazio ou colocar algum conteúdo principal inicial
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

                $post->sections()->create([
                    'type' => 'media',
                    'content' => $path, // Salve o caminho relativo
                ]);
            }
        }
    }

    return redirect()->route('posts.index')->with('success', 'Post criado com sucesso!');
}

    //public function show($id)
    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);
        $post = Post::with('sections')->findOrFail($post->id);
        dd($post->sections); // Adicione esta linha para verificar o que está sendo carregado
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
