<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends \Illuminate\Routing\Controller
{
    // Construtor com middleware
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    // Exibe a lista de posts com paginação
    public function index()
    {
        // Obter os últimos posts
        $recentPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('recentPosts', 'posts'));
    }

    // Exibe o formulário para criação de um novo post
    public function create()
    {
        return view('posts.create');
    }

    // Armazena um novo post no banco de dados
    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        // Criação do novo post
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        // Redireciona para a página de visualização do post
        return redirect()->route('posts.show', $post->id);
    }

    // Exibe um post específico
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // Exibe o formulário para edição de um post
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $recentPosts = Post::orderBy('created_at', 'desc')->take(5)->get();
        return view('posts.edit', compact('post', 'recentPosts'));
    }

    // Atualiza um post existente
    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,gif,mp4,mov,avi|max:20480', // 20MB max
        ]);

        // Encontrar o post existente
        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];

        // Verificar se há um novo arquivo de mídia
        if ($request->hasFile('media')) {
            // Excluir a mídia antiga, se existir
            if ($post->media) {
                Storage::delete('public/' . $post->media);
            }

            // Armazenar a nova mídia
            $path = $request->file('media')->store('media', 'public');
            $post->media = $path;
        }

        // Salvar as alterações
        $post->save();

        // Redirecionar para a página de visualização do post
        return redirect()->route('posts.show', $post->id);
    }

    // Exclui um post existente
    public function destroy($id)
    {
        // Encontrar o post existente
        $post = Post::findOrFail($id);

        // Excluir a mídia associada, se existir
        if ($post->media) {
            Storage::delete('public/' . $post->media);
        }

        // Excluir o post
        $post->delete();

        // Redirecionar para a lista de posts com uma mensagem de sucesso
        return redirect()->route('posts.index')->with('success', 'Post deletado com sucesso.');
    }
}
