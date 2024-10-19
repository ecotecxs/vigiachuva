<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <!-- Adicionar ícones do Font Awesome para o lápis -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="conta.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .user-info {
            margin: 20px;
        }

        .user-info label {
            font-weight: bold;
        }

        .edit-icon {
            cursor: pointer;
            margin-left: 10px;
        }

        /* Estilos do modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 300px;
            text-align: center;
            background-color:  #103349;
        }

        .close {
            float: right;
            font-size: 20px;
            cursor: pointer;
            
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="home.html"><img src="img/logo.png" alt="logo"></a>
                <h1>Vigia Chuva</h1>
            </div>
            <div class="nav-right">
                <a href="notificacao.html"><img src="img/packard-bell.png" alt="Ícone 1"></a>
            </div>
        </nav>
    </header>

    <?php
    // Conexão com o banco de dados (usando MySQLi como exemplo)
    include 'conexao.php';

    // Verificar conexão
    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Supomos que o ID do usuário esteja disponível via sessão ou URL
    $userId = 2; // Exemplo de ID do usuário

    $sql = "SELECT email, nm_user, senha FROM tb_user WHERE id_user = ?";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
        die("Erro ao preparar a consulta: " . $conexao->error);
    }

    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($email, $nm_user, $senha);
    $stmt->fetch();
    $stmt->close();
    $conexao->close();
    ?>

    <nav class="menu-inferior">
        <a href="user.html"> <img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.html"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapa.html"> <img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comentario.html"> <img src="img/conversacao.png" alt="Ícone 4"></a>
    </nav>


    <div id="center">
        <div id="infoconta">
            <div id="ti">
                <h1 id="titulo">DADOS PESSOAIS</h1>
            </div>
            <div class="user-info">
                <div class="titulos"><label>EMAIL</label></div>
                <div class="borda"><span><?php echo htmlspecialchars($email); ?></span></div>
            </div>
            <div class="user-info">
                <div class="titulos"><label>NOME DO USUARIO</label></div>
                <div class="borda">
                    <span><?php echo htmlspecialchars($nm_user); ?></span>
                    <i class="fas fa-pencil-alt edit-icon" id="edit-username"></i>
                </div>
            </div>
            <div class="user-info">
                <div class="titulos"><label>SENHAS</label></div>
                <div class="borda"><span><?php echo htmlspecialchars($senha); ?></span> </div><!-- Exibindo apenas asteriscos por segurança -->
            </div>
        </div>
    </div>

    <!-- Modal para edição -->
    <div class="modal" id="modal-edit-username">
        <div class="modal-content">
            <span class="close" id="close-modal">&times;</span>
            <h2 id="troca">Editar Nome de Usuário</h2>
            <form method="POST" action="atualizar.php">
                <input type="hidden" name="user_id" value="<?php echo $userId; ?>" />
                <input type="text" name="username" value="<?php echo htmlspecialchars($nm_user); ?>" />
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>

    <script>
        // Abrir modal
        document.getElementById('edit-username').addEventListener('click', function() {
            document.getElementById('modal-edit-username').style.display = 'flex';
        });

        // Fechar modal
        document.getElementById('close-modal').addEventListener('click', function() {
            document.getElementById('modal-edit-username').style.display = 'none';
        });

        // Fechar modal ao clicar fora do conteúdo
        window.addEventListener('click', function(event) {
            var modal = document.getElementById('modal-edit-username');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    </script>

</body>

</html>