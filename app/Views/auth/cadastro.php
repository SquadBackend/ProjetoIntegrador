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
        <?php if(session()->getFlashdata('erro_interno')) : ?>
            <div class="info">
                <div class="message">
                    <p class="message-text"><?php echo session()->getFlashdata('erro_interno'); ?></p>
                </div>
            </div>
        <?php endif ?>
        <form action="<?php echo site_url('cadastro', 'http'); ?>" method="post">

            <div class="form-input-label">
                <p>Nome</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('nome') ?></p>
                <?php endif;?>
            </div>
            <input type="text" name="nome" id="usuario" value="<?php if(isset($nome)) { echo $nome;} ?>" placeholder="Ana">

            <div class="form-input-label">
                <p>CPF</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('cpf') ?></p>
                <?php endif;?>
            </div>
            <input type="text" name="cpf" id="usuario" value="<?php if(isset($cpf)) { echo $cpf;} ?>" placeholder="XXX.XXX.XXX-XX" onkeypress="validarNumero(event)">

            <div class="form-input-label">
                <p>Matricula</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('matricula') ?></p>
                <?php endif;?>
            </div>
            <input type="text" name="matricula" id="senha" value="<?php if(isset($matricula)) { echo $matricula;} ?>" placeholder="XXXXXXXXXXXX"onkeypress="validarNumero(event)">

            <div class="form-input-label">
                <p>E-mail</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('email') ?></p>
                <?php endif;?>
            </div>
            <input type="email" name="email" id="usuario" value="<?php if(isset($email)) { echo $email;} ?>" placeholder="@reallygreatsite" required>

            <div class="form-input-label">
                <p>Senha</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('senha') ?></p>
                <?php endif;?>
            </div>
            <input type="password" name="senha" id="usuario" placeholder="********">

            <div class="form-input-label">
                <p>Repita sua senha</p>
                <?php if(isset($validation)):?>
                    <p class="erro"><?= $validation->getError('senhaconf') ?></p>
                <?php endif;?>
            </div>
            <input type="password" name="senhaconf" id="usuario" placeholder="********">

            <div class="row"><input type="checkbox" name="lembre" id="lembre"><label for="lembre">Lembre-se de mim</label></div>
            <button type="submit" class="entrar">CADASTRAR-SE</button>
        </form>

    </div>
    <script src="/js/script.js"></script>
</body>
</html>
