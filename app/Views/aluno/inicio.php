<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/menualuno.css">
    <title>Início</title>
</head>
<body>
    <div class="acess">
        <a href="<?php echo site_url('sair',METHOD);  ?>"><img class="/chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <center>Menu</center>
    </div>
    <div class="ft">
        <img src="/img/logo.png" alt="a" class="saborear">
    </div>
    <?php $message = null; if(session()->get('verificado') == 0) {$message = "(Sua conta ainda não foi confirmada)";}elseif(session()->get('bloqueado') == 1){$message = "(Sua conta foi bloqueada)";} ?>
    
    <div class="tt">
        <a <?php if(!$message) {echo 'href="' . site_url('aluno/reservar', METHOD) . '"';} ?> style="text-decoration: none;"><p>RESERVAR <?php if($message) {echo '<span style="color: red;">' . $message . '</span>';} ?></p></a>
    </div>        
    <hr>
    <div class="tt">
        <a <?php if(!$message) {echo 'href="' . site_url('aluno/pagamento', METHOD) . '"';} ?> style="text-decoration: none;"><p>PAGAMENTO <?php if($message) {echo '<span style="color: red;">' . $message . '</span>';} ?></p></a>
    </div>
    <hr>
    
    <div class="tt">
        <a href="<?php echo site_url('aluno/cardapio',METHOD);  ?>" style="text-decoration: none;"><p>CARDÁPIO</p></a>
    </div>
    <hr>
    <div class="tt">
        <a href="<?php echo site_url('aluno/historico',METHOD);  ?>" style="text-decoration: none;"><p>CONSULTAR HISTÓRICO</p></a>
    </div>
    <hr>
</body>
</html>