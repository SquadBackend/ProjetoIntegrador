<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reservar.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Reservar</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo site_url('aluno/inicio','http'); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <span class="header title">RESERVAR</span>
    </div>
    <div class="main">
        <div class="form-group">
            <form action="<?php echo site_url('aluno/reservar', 'http'); ?>" method="post">
                <label for="date">ESCOLHA O DIA:</label>
                <input type="date" name="date" id="date">

                <label for="turno">QUAL TURNO:</label>
                <input type="text" name="turno" id="turno">

                <label for="login">LOGIN:</label>
                <input type="text" name="login" id="login">
                <p>uso do login para confirmar a reserva</p>


                <a onclick="Reservar();" class="reservar-button">reservar</a>

                <input type="hidden" name="userId" id="userId" value="<?php echo session()->get('id'); ?>">
            </form>
            <div class="info" id="info"> </div>
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
        </div>
    </div>
    <script>
        const Usuario_idElem = document.querySelector("#userId");
        const DataElem = document.querySelector("#date");
        const TurnoElem = document.querySelector("#turno");

        async function Reservar()
        {
            const res = await axios.post("/api/pedidos/", {
                "Usuario_id" : Usuario_idElem.value,
                "Data" : DataElem.value,
                "Turno" : TurnoElem.value,
            });
            if(res.status == 201){
                console.log("reservado com sucesso!");
                document.querySelector("#info").innerHTML = '<div class="info"><div class="message sucesso"><p>A reserva ( ' + DataElem.value + ' ) foi efetuada com sucesso!</p></div></div>';
            }else{
                console.log("Ocorreu um erro!");
                console.log(res);
                document.querySelector("#info").innerHTML = '<div class="info"><div class="message erro"><p>Ocorreu um erro na efetuação da reserva ( ' + DataElem.value + ' )</p></div></div>';
            }

        }
    </script>
</body>
</html>
