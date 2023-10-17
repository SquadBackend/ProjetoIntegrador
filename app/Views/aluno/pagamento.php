<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/pagamento.css">
    <title>Pagamento</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo base_url() . 'aluno/inicio/'; ?>"><img class="chevron-left" src="/chevron-left.svg" alt=""></a>
        <span class="header title">PAGAMENTO</span>
    </div>
    <div class="main">
        <div class="service-list">

                <?php foreach($pedidos as $pedido): ?>
                    <div class="service-container">
                        <p class="service-name"><?php echo $pedido['Data']; ?></p>
                        <p class="service-price">R$ <?php echo $pedido['Preco']; ?></p>
                    </div>
                    <hr>
                <?php endforeach ?>
            <div class="service-container">
                <p class="service-name">TOTAL</p>
                <p class="service-price">R$ <?php echo $total; ?></p>
            </div>
        </div>

        <img class="qrcode" src="https://www.canalautismo.com.br/wp-content/uploads/2018/05/qrcode-RevistaAutismo.png" >

        <p class="label">COMPROVANTE DE PAGAMENTO</p>

        <button>Adicione o comprovante</button>
    </div>

</body>
</html>
