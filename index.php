<?php
$con = new PDO("mysql:host=localhost;dbname=biblioteca", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="icon" href="/img/37237.png" type="image/png">
    <script src="https://kit.fontawesome.com/1ab94d0eba.js" crossorigin="anonymous"></script>
    <title>Bookstan</title>
</head>

<body>

    <?php
    class Login
    {
        private $username = "admin"; // Nome de usuário válido
        private $senha = "bookstan"; // Senha válida

        public function validarLogin($username, $senha)
        {
            if ($username == $this->username && $senha == $this->senha) {
                return true;
            } else {
                return false;
            }
        }
    }

    if (isset($_POST['username']) && isset($_POST['senha'])) {
        $username = $_POST['username'];
        $senha = $_POST['senha'];

        // Instancie a classe Login
        $login = new Login();

        // Verifique as credenciais
        if ($login->validarLogin($username, $senha)) {
            // Login bem-sucedido, redirecione o usuário para a página de sucesso
            header('Location: http://localhost/biblioteca.php"');
            exit();
        } else {
            // Login inválido, exiba uma mensagem de erro
            echo "Nome de usuário ou senha inválidos.";
        }
    }
    ?>

    <br>
    <br>

    <form method="POST" action="http://localhost/biblioteca.php" class="d-flex justify-content-center">
        <fieldset class="form-group container">
            <h2>Login</h2>
            <!-- <form action=""> -->
            <div class="mb-3">
                <label for="">Usuário</label>
                <input class="form-control" type="text" name="username" value="admin" placeholder="Digite seu usuário">
                <div class="underline"></div>
            </div>
            <div class="mb-3">
                <label for="">Senha</label>
                <input class="form-control" type="password" name="senha" value="bookstan" placeholder="Digite sua senha">
                <div class="underline"></div>
            </div>
            <a href="http://localhost/biblioteca.php"></a>
            <input type="submit" value="Continue" class="btn btn-primary">

        </fieldset>
    </form>

</body>

</html>
