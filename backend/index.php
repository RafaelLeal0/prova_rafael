<!-- Rafael Gustavo Leal dos Santos n°27 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" type="image/png" href="../img/logo_top.png">
    <title>Página Inicial</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hamburger = document.querySelector('.hamburger');
            const navbar = document.querySelector('.navbar');
            if (hamburger && navbar) {
                hamburger.addEventListener('click', function() {
                    navbar.classList.toggle('active');
                });
            }
        });
    </script>
</head>
<style>
    h2 {
        text-align: center;
        margin-top: 20px;
    }
    p{
        text-align:center;
    }
    .logo-img {
        display: block;
        margin: 20px auto;
        max-width: 200px;
        height: auto;
        border-radius: 18px;
    }  
    h3 {
        text-align: center;
        margin-top: 20px;
    }
    section {
        background: #f5f6fa;
        border-radius: 18px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        max-width: 600px;
        margin: 30px auto 0 auto;
        padding: 32px 24px 28px 24px;
        transition: box-shadow 0.2s;
    }
    section:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    }
    @media (max-width: 700px) {
        section {
            max-width: 98vw;
            padding: 16px 4vw 16px 4vw;
        }
        .logo-img {
            max-width: 90vw;
        }
    }
    @media (max-width: 600px) {
          .navbar {
            flex-direction: column;
            align-items: stretch;
            gap: 4px;
        }
    }
</style>
<body>
    <div class="navbar">
        <a href="index.php">Início</a>
        <a href="cadastro_usuario.php">Cadastrar usuários</a>
        <a href="cadastro_tarefa.php">Cadastrar tarefa</a>
        <a href="gerenciar_tarefas.php" class="active">Gerenciar tarefas</a>
    </div>
</div>
    <main>
        <h2>Bem-vindo ao TaskSync</h2>
        <section>
        <h3>Nossa Logo:</h3>
        <img src="../img/logo_alternativa.png" alt="Logo do TaskSync" class="logo-img">
        <h3>O que nós somos?</h3>
        <p>O TaskSync é um sistema de gerenciamento de tarefas que visa facilitar a organização e o acompanhamento de atividades em equipe. Com uma interface intuitiva e recursos avançados, o TaskSync permite que os usuários criem, editem e gerenciem tarefas de forma eficiente.</p>
        </section>
    </main>
</body>
</html>