<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Post</title>
    <!-- Link para o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script> <!-- FontAwesome para ícones -->
    <style>
        /* Definindo a imagem de fundo para a página inteira */
        body {
            background-image: url('https://via.placeholder.com/1920x1080'); /* Substitua o URL pela sua imagem */
            background-size: cover; /* Faz a imagem cobrir toda a tela */
            background-position: center; /* Centraliza a imagem */
            background-attachment: fixed; /* Fixa a imagem ao rolar a página */
            color: #fff; /* Cor do texto para garantir que fique visível sobre a imagem */
        }

        /* Estilos adicionais para melhorar a legibilidade do conteúdo */
        .container {
            background-color: rgba(0, 0, 0, 0.5); /* Fundo semitransparente para melhorar a leitura */
            padding: 30px;
            border-radius: 8px;
        }

        /* Estilo do rodapé */
        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        /* Estilo da área de comentários e formulário */
        #commentForm {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<!-- Barra de navegação -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Meu Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contato</a>
            </li>
        </ul>
        <!-- Barra de Pesquisa -->
        <form class="form-inline my-2 my-lg-0" action="#" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Buscar..." aria-label="Buscar">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
    </div>


    <!-- Seção de Comentários -->
    <div class="row">
        <div class="col-12">
            <h3>Comentários</h3>

            <!-- Exemplo de Comentário -->
            <div class="media mb-4">
                <img src="https://via.placeholder.com/50" class="mr-3" alt="Avatar">
                <div class="media-body">
                    <h5 class="mt-0">João Silva</h5>
                    <p>Ótimo post! Aprendi muito com isso.</p>
                </div>
            </div>

            <div class="media mb-4">
                <img src="https://via.placeholder.com/50" class="mr-3" alt="Avatar">
                <div class="media-body">
                    <h5 class="mt-0">Maria Oliveira</h5>
                    <p>Interessante! Fiquei com algumas dúvidas, mas vou procurar mais sobre isso.</p>
                </div>
            </div>

            <!-- Formulário de Comentário -->
            <button class="btn btn-primary" id="toggleCommentForm">Adicionar Comentário</button>

            <div class="mt-4" id="commentForm" style="display: none;">
                <h4>Deixe seu Comentário</h4>
                <form id="commentFormSubmit">
                    <div class="form-group">
                        <label for="username">Seu Nome</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="commentText">Comentário</label>
                        <textarea class="form-control" id="commentText" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Enviar Comentário</button>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Rodapé -->
<footer class="bg-light text-center py-4">
    <p>&copy; 2025 Meu Blog - Todos os direitos reservados</p>
</footer>

<!-- Scripts do Bootstrap e do jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Script de JavaScript para alternar o formulário de comentário -->
<script>
    document.getElementById('toggleCommentForm').addEventListener('click', function() {
        var form = document.getElementById('commentForm');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    });

    // Função para enviar o comentário (simulação)
    document.getElementById('commentFormSubmit').addEventListener('submit', function(e) {
        e.preventDefault();
        alert("Comentário enviado!");
        // Aqui você pode adicionar a lógica para enviar o comentário para o servidor
    });
</script>

</body>
</html>


