<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="login">CADASTRAR-SE</div>
    <div class="form-group">
        <form action="<?php echo base_url() . 'cadastro/'; ?>" method="post">
            Nome <BR></BR>
            <input type="text" name="nome" id="usuario" placeholder="Ana"> <BR></BR> <br>
            CPF <BR></BR>
            <input type="text" name="cpf" id="usuario" placeholder="XXX.XXX.XXX-XX" onkeypress="validarNumero(event)"> <BR></BR> <br>
            Matrícula <BR></BR>
            <input type="text" name="matricula" id="senha" placeholder="XXXXXXXXXXXX"onkeypress="validarNumero(event)"> <BR></BR> <br>
            E-mail <BR></BR>
            <input type="email" name="email" id="usuario" placeholder="@reallygreatsite" required> <BR></BR> <br>
            Senha <BR></BR>
            <input type="password" name="senha" id="usuario" placeholder="********"> <BR></BR> <br>
            Repita sua senha <BR></BR>
            <input type="password" name="senha" id="usuario" placeholder="********"> <BR></BR> <br>
            <input type="checkbox" name="lembre" id="lembre"> Lembre-se de mim <BR></BR>
            <button type="submit" class="entrar">CADASTRAR-SE</button> <br> <br>
        </form>

    </div>
    <script src="/js/script.js"></script>
</body>
</html>
