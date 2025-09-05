<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Gestão Escolar</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body id="pagina-login">

        <form id="form-login" action="../inludes/validacao_login.php" method="POST">
            <h1 id="form-titulo-login" >Gestão Escolar</h1>
            <p id="form-subtitulo-login">Preencha suas credenciais de login para continuar</p>

            <label class="credenciais-login" for="usuario-email">E-mail</label>
            <input  class="credenciais-login" type="email" name="usuario-email" placeholder="email@gestaoescolar.com.br" required>

            <label  class="credenciais-login" for="usuario-senha">Senha</label>
            <input  class="credenciais-login" type="password" name="usuario-senha" placeholder="senhadeacesso" required>

            <div id="container-btn-login">
                <button id="form-btn" type="submit">Entrar</button>
            </div>
        </form>

    </body>
</html>