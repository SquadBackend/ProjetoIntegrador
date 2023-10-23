<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menucant.css">
    <title>Document</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo site_url('sair', 'https'); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Menu</center>
    </div>
    <div class="ft">
        <img src="/img/logo.png" alt="a" class="saborear">
    </div>
    <div class="tt">
        <a href="<?php echo site_url('cantina/cadastros','https'); ?>" style="text-decoration: none;"><p>ACESSO AOS CADASTROS</p></a>
    </div>        
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('cantina/cardapio','https'); ?>" style="text-decoration: none;"><p>CARDÁPIO DO DIA</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('cantina/reservas','https'); ?>" style="text-decoration: none;"><p>ACOMPANHAMENTO DE RESERVAS</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('cantina/pagamentos','https'); ?>" style="text-decoration: none;"><p>PAGAMENTO</p></a>
    </div>
    <hr>
</body>
</html>
