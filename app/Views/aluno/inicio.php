<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menualuno.css">
    <title>Document</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo site_url('sair','https');  ?>"><img class="/chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Menu</center>
    </div>
    <div class="ft">
        <img src="/img/logo.png" alt="a" class="saborear">
    </div>
    <div class="tt">
        <a href="<?php echo site_url('aluno/reservar','https');  ?>" style="text-decoration: none;"><p>RESERVAR</p></a>
    </div>        
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('aluno/pagamento','https');  ?>" style="text-decoration: none;"><p>PAGAMENTO</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('aluno/cardapio','https');  ?>" style="text-decoration: none;"><p>CARDÁPIO</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('aluno/historico','https');  ?>" style="text-decoration: none;"><p>CONSULTAR HISTÓRICO</p></a>
    </div>
    <hr>
</body>
</html>