<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="login">LOGIN</div>
    <div class="form-group">

        <?php
                $flagInfo = 0;
                $flagData = [1 => 'sucesso', 2 => 'erro'];
                if(session()->getFlashdata('sucesso')) { $flagInfo = 1; } elseif (session()->getFlashdata('erro')) { $flagInfo = 2;}

                if($flagInfo > 0) : ?>
                    <div class="info">
                        <div class="message <?= $flagData[$flagInfo]; ?>">
                            <p><?= session()->getFlashdata($flagData[$flagInfo]); ?></p>
                        </div>
                    </div>
                <?php endif ?>

        <form action="<?php  echo site_url('', 'http'); ?>" method="post">
            <div class="form-input-label">
                <p>USUÁRIO:</p>
            </div>
            <input type="text" name="usuario" id="usuario" placeholder="XXXXXXXXX" onkeypress="validarNumero(event)">

            <div class="form-input-label">
                <p>SENHA:</p>
            </div>
            <input type="password" name="senha" id="senha" placeholder="********">

            <input type="checkbox" name="lembre" id="lembre"> Lembre-se de mim
            <button type="submit" class="entrar" onclick="Login(event);">ENTRAR</button>
            <div class="oth">
                <p>Esqueceu sua senha?</p>
                <a href="<?php echo site_url('cadastro', 'http'); ?>">Cadastrar-se</a>
            </div>
        </form>
    </div>
    <script src="script.js"></script>
</body>
</html>
