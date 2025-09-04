<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Gestão Escolar</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>

        <form action="../inludes/validacao_login.php" method="POST">
            <h1>Gestão Escolar</h1>
            <p>Preencha suas credenciais de login para continuar</p>

            <label for="usuario-email">E-mail</label>
            <input type="email" name="usuario-email" placeholder="email@gestaoescolar.com.br" required>

            <label for="usuario-senha">Senha</label>
            <input type="password" name="usuario-senha" placeholder="senhadeacesso" required>

            <div id="btn-container">
                <button type="submit">Entrar</button>
            </div>
        </form>

    </body>
</html>