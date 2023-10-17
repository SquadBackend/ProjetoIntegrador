<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
</head>
<body>
    <p>Olá, <b><?php echo session()->get('nome'); ?></b></p>
    <a href="<?php echo base_url() . 'aluno/reservar/';  ?>">RESERVAR</a>
    <a href="<?php echo base_url() . 'aluno/pagamento/'; ?>">PAGAMENTO</a>
    <a href="<?php echo base_url() . 'aluno/cardapio/';  ?>">CARDÁPIO</a>
    <a href="<?php echo base_url() . 'aluno/historico/'; ?>">HISTÓRICO</a>
    <a href="<?php echo base_url() . 'sair/'; ?>">Sair</a>
</body>
</html>
