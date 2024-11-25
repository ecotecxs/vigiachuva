<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <!-- Adicionar ícones do Font Awesome para o lápis -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                <a href="notificacao.php"><img src="img/packard-bell.png" alt="Ícone 1"></a>
            </div>
        </nav>
    </header>

<?php
session_start();  // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header('Location: login.php');
    exit;
}

// Conexão com o banco de dados
include 'conexao.php';

// Recupera o ID do usuário da sessão
$userId = $_SESSION['user_id'];

// Consulta para obter os dados do usuário logado
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
        <a href="user.php"> <img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.php"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapa.html"> <img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comunidade.php"> <img src="img/conversacao.png" alt="Ícone 4"></a>
    </nav>

    <h1 class="dados">DADOS PESSOAIS</h1>

    <div id="center">
        <div id="infoconta">
            <div class="user-info">
                <div class="titulos"><label>Email</label></div>
                <div class="borda"><span><?php echo htmlspecialchars($email); ?></span></div>
            </div>
            <div class="user-info">
                <div class="titulos"><label>Nome do Usuário</label></div>
                <div class="borda">
                    <span><?php echo htmlspecialchars($nm_user); ?></span>
                    <i class="fas fa-pencil-alt edit-icon" id="edit-username"></i>
                </div>
            </div>
            <div class="user-info">
                <div class="titulos"><label>Senha</label></div>
                <div class="borda"><span>*****</span> </div><!-- Exibindo apenas asteriscos por segurança -->
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