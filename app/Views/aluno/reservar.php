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
        <a href="<?php echo site_url('aluno/','http'); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <span class="header title">RESERVAR</span>
    </div>
    <div class="main">
        <div class="form-group">
            <form action="<?php # echo site_url('aluno/reservar', 'http'); ?>" method="post">
                <label for="date">ESCOLHA O DIA:</label>
                <input type="date" name="date" id="date">

                <label for="turno">QUAL TURNO:</label>
                <select name="turno" id="turno">
                    <option value="almoço">Almoço</option>
                    <option value="jantar">Jantar</option>
                </select>
    
                

                <button type="submit" onclick="Reservar(event);" class="reservar-button">reservar</button>

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
            event.preventDefault();
            let reservaData = DataElem.value.split("-");
            reservaData = reservaData[2] + "/" + reservaData[1] + "/" + reservaData[0];
            if(DataElem.value != ""){
                try {
                    const res = await axios.post("/api/pedidos/", {
                        "Usuario_id" : Usuario_idElem.value,
                        "Data" : DataElem.value,
                        "Turno" : TurnoElem.value,
                        "Pago": 0
                    })

                    if(res.status == 201){
                        console.log("reservado com sucesso!");
                        document.querySelector("#info").innerHTML = '<div class="info" id="info"><div class="message sucesso"><p>A reserva ( ' + reservaData + ' ) foi efetuada com sucesso!</p></div></div>';
                        DataElem.value = "";
                    }
                } catch (error){
                    console.log("Ocorreu um erro!");
                    console.log(error);

                    if(error.response.status == 409){
                        document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>' + error.response.data.messages.error + '</p></div></div>';
                    }else if(error.response.status == 400){
                        document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>' + error.response.data.messages.error + '</p></div></div>';
                    }else{
                        document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Ocorreu um erro interno.</p></div></div>';
                    }
                    
                }
                
            }else {
                document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Você deve preencher o formulário!</p></div></div>';
            }
            

        }
    </script>
</body>
</html>
