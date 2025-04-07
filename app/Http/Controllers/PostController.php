<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Construtor com middleware
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    // Lista os posts com paginação
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    // Exibe o formulário de criação
    public function create()
    {
        return view('posts.create');
    }

    // Armazena um novo post
    public function store(Request $request)
    {
        // Corrigir validações
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'sections' => 'required|array',
            'sections.*.type' => 'required|in:text,media',
            'sections.*.content' => 'required_if:sections.*.type,text',
            'sections.*.file' => 'required_if:sections.*.type,media|file|mimes:jpg,png,jpeg,gif,mp4,mov,avi|max:20480',
        ]);

        // Cria o post
        $post = Post::create([
            'title' => $validatedData['title'],
        ]);

        // Cria as seções
        foreach ($request->sections as $index => $sectionData) {
            $type = $sectionData['type'];
            $section = new Section();
            $section->post_id = $post->id;
            $section->type = $type;

            if ($type === 'text') {
                $section->content = $sectionData['content'];
            } elseif ($type === 'media' && $request->hasFile("sections.$index.file")) {
                $file = $request->file("sections.$index.file");
                $path = $file->store('sections', 'public');
                $section->content = $path;
            }

            $section->save();
        }

        return redirect()->route('posts.show', $post->id)->with('success', 'Post criado com sucesso!');
    }

    // Exibe um post específico
    public function show($id)
    {
        $post = Post::with('sections')->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Formulário de edição
    public function edit($id)
    {
        $post = Post::with('sections')->findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    // Atualiza um post
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,gif,mp4,mov,avi|max:20480',
            'sections.*.content' => 'nullable|string',
            'new_section' => 'nullable|string',
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

        // Atualiza seções existentes
        if ($request->has('sections')) {
            foreach ($request->sections as $index => $sectionData) {
                $section = $post->sections()->find($index);
                if ($section) {
                    $section->content = $sectionData['content'];
                    $section->save();
                }
            }
        }

        // Adiciona nova seção se existir
        if ($request->filled('new_section')) {
            $post->sections()->create([
                'content' => $request->new_section,
                'type' => 'text',
            ]);
        }

        return redirect()->route('posts.show', $post->id)->with('success', 'Post atualizado com sucesso!');
    }

    // Deleta post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        foreach ($post->sections as $section) {
            if ($section->type !== 'text' && $section->content) {
                Storage::delete('public/' . $section->content);
            }
        }

        $post->sections()->delete();
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deletado com sucesso.');
    }
}
