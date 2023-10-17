<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="login">LOGIN</div>
    <div class="form-group">
        <form action="/" method="post">
            USUÁRIO: <br></br>
            <input type="text" name="usuario" id="usuario" placeholder="XXXXXXXXX" onkeypress="validarNumero(event)"> <br></br> <br>
            SENHA: <br></br>
            <input type="password" name="senha" id="senha" placeholder="********"> <br></br> <br>
            <input type="checkbox" name="lembre" id="lembre"> Lembre-se de mim <br></br>
            <button type="submit" class="entrar">ENTRAR</button> <br> <br>
            <div class="oth">
                Esqueceu sua senha? <br><br>
                <a href="cadastro/">Cadastrar-se</a>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>