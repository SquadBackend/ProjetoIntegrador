<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menucae.css">
    <title>Início</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo site_url('sair',METHOD); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Menu</center>
    </div>
    <div class="ft">
        <img src="/img/logo.png" alt="a" class="saborear">
    </div>
    <div class="tt">
        <a href="<?php echo site_url('cae/cadastros', METHOD); ?>" style="text-decoration: none;"><p>ACESSO AOS CADASTROS</p></a>
    </div>        
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('cae/reservas', METHOD); ?>" style="text-decoration: none;"><p>RESERVAS DO DIA</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('cae/historico', METHOD); ?>" style="text-decoration: none;"><p>HISTÓRICO DE RESERVAS</p></a>
    </div>
    <hr>
</body>
</html>
