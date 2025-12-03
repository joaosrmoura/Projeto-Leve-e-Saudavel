<?php
    // Conecta à classe Usuario
    require 'usuario.php';
    $u = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - ADS Burger</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/login.css"> <link rel="shortcut icon" href="imagens/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> 
    
    <style>
        /* Ajuste rápido para as mensagens de erro/sucesso não quebrarem o layout */
        .msg-sucesso { background-color: #4CAF50; color: white; padding: 10px; margin-top: 10px; text-align: center; border-radius: 5px; }
        .msg-erro { background-color: #ff3333; color: white; padding: 10px; margin-top: 10px; text-align: center; border-radius: 5px; }
    </style>
</head>
<body>

    <header>
        <div class="header-container">
            <nav id="navbar">
                <a href="index.html" style="color: white; font-size: 20px; margin-right: 20px;">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                
                <ul id="nav-list">
                    <li class="nav-item"><a href="index.html" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="login.html" class="nav-link">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="login-section">
        <div class="login-container">
            <h2>CRIAR CONTA</h2>
            
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome Completo" maxlength="30" required>
                <input type="email" name="email" placeholder="Seu E-mail" maxlength="40" required>
                <input type="tel" name="telefone" placeholder="Telefone" maxlength="30">
                <input type="text" name="endereco" placeholder="Endereço" maxlength="50">
                <input type="text" name="cidade" placeholder="Cidade" maxlength="30">
                <input type="text" name="estado" placeholder="Estado" maxlength="30">
                <input type="password" name="senha" placeholder="Senha" maxlength="15" required>
                <input type="password" name="Confsenha" placeholder="Confirmar Senha" maxlength="15" required>
                
                <button type="submit" class="btn" style="width: 100%; margin-top: 10px;">CADASTRAR</button>
            </form>
            
            <p style="color: white; margin-top: 15px;">
                Já tem conta? <a href="login.html" style="color: #eebb4d;">Entrar</a>
            </p>

            <?php
            // Verifica se clicou no botão
            if(isset($_POST['nome'])) {
                $nome = addslashes($_POST['nome']); 
                $email = addslashes($_POST['email']);
                $endereco = addslashes($_POST['endereco']);
                $cidade = addslashes($_POST['cidade']);
                $estado = addslashes($_POST['estado']);
                $telefone = addslashes($_POST['telefone']);
                $senha = addslashes($_POST['senha']);
                $confSenha = addslashes($_POST['Confsenha']);

                // Verifica campos obrigatórios
                if(!empty($nome) && !empty($email) && !empty($senha)) {
                    
                    // CONECTAR AO BANCO (Atenção ao nome do banco e host)
                    $u->conectar("estacio2025", "localhost", "root", "");

                    if($u->msgErro == "") { // Conexão OK
                        if($senha == $confSenha) {
                            // Tenta cadastrar
                            if($u->cadastrarUsuario($nome, $endereco, $cidade, $estado, $telefone, $email, $senha)) {
                                echo "<div class='msg-sucesso'>Cadastrado com sucesso! Faça login.</div>";
                            } else {
                                echo "<div class='msg-erro'>Email já cadastrado!</div>";
                            }
                        } else {
                            echo "<div class='msg-erro'>Senhas não conferem!</div>";
                        }
                    } else {
                        echo "<div class='msg-erro'>Erro de conexão: ".$u->msgErro."</div>";
                    }
                } else {
                    echo "<div class='msg-erro'>Preencha todos os campos!</div>";
                }
            }
            ?>
        </div>
    </section>

</body>
</html>