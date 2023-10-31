<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/pagamento.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Pagamento</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo site_url('aluno/',METHOD); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <span class="header title">PAGAMENTO</span>
    </div>
    <div class="main">
        <div id="back">
            <dialog id="alterarDialog" class="MegaDialog">
                <header>
                    <p>Alterar o pedido</p>
                </header>
                <article>
                <div class="DialogInfo"  id="DialogInfo"></div>
                    <div class="input-div">
                        <label for="date">Alterar o dia:</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div class="input-div">
                        <label for="turno">Alterar o turno:</label>
                        <select name="turno" id="turno">
                            <option value="almoço">Almoço</option>
                            <option value="jantar">Jantar</option>
                        </select>
                    </div>

                    
                </article>
                <footer>
                    <button autofocus onclick="this.closest('dialog').close('cancel');document.querySelector('#back').style.display = 'none';">Cancelar</button>
                    <button onclick="Editar(event);">Editar</button>
                </footer>
            </dialog>
        </div>
        <div class="info" id="info"></div>
        <div class="service-list" id="service-list">
                
                <?php foreach($pedidos as $pedido): ?>
                    <div class="service-container" id="service-container-<?= $pedido['id']; ?>">
                        <div class="service-info">
                            <p class="service-name" id="service-name-<?= $pedido['id']; ?>"><?= date("d/m/Y", strtotime($pedido['Data'])); ?></p>
                            <p class="service-shift" id="service-shift-<?= $pedido['id']; ?>"><?= $pedido['Turno']; ?></p>                        
                            <p class="service-price" id="service-price-<?= $pedido['id']; ?>">R$ <?= $pedido['Preco']; ?></p>
                        </div>    
                        <div class="service-options">
                            <button onclick="MostrarEditar(<?= $pedido['id']; ?>)">Alterar</button>
                            <button onclick="Deletar(<?= $pedido['id']; ?>)">Cancelar</button>
                        </div>
                        
                    </div>
                    <hr id="service-line-<?= $pedido['id']; ?>">
                <?php endforeach ?>
                
            <div class="service-container">
                <div class="service-info">
                    <p class="service-name">TOTAL</p>
                    <p class="service-price" id="total-price" style="grid-column: 3;">R$ <?= $total; ?></p>
                </div>
            </div>
        </div>
        <div class="functions">
            <img class="qrcode" src="https://www.canalautismo.com.br/wp-content/uploads/2018/05/qrcode-RevistaAutismo.png" >
            <input type="hidden" name="userId" id="userId" value="<?= session()->get('id'); ?>">
            <button onclick="Pagar(event);">Já paguei</button>
        </div>
        

    
        
    </div>
    <script>

        var target_id;

        const Usuario_idElem = document.querySelector("#userId");
        const DataElem = document.querySelector("#date");
        const TurnoElem = document.querySelector("#turno");
        const Back = document.querySelector('#back');
        const AlterarDialog = document.querySelector('#alterarDialog');


        function MostrarEditar(id){
            Back.style.display = 'block';
            AlterarDialog.showModal();
            //AlterarDialog.style.top = ((window.innerHeight/2) - (AlterarDialog.offsetHeight/2))+'px';
            //AlterarDialog.style.left = ((window.innerWidth/2) - (AlterarDialog.offsetWidth/2))+'px';
            target_id = id;
            TurnoElem.value = document.querySelector('#service-shift-' + id).innerText;
            reservaData = document.querySelector('#service-name-' + id).innerText.split("/");
            reservaData = reservaData[2] + "-" + reservaData[1] + "-" + reservaData[0];
            DataElem.value = reservaData;

        }

        async function Deletar(id){
            event.preventDefault();
            try {
                const res = await axios.delete("/api/pedidos/" + id);
                if(res.status == 200){
                    console.log("deletado com sucesso.");
                    document.querySelector("#info").innerHTML = '<div class="info" id="info"></div>';
                    var servicePrice = document.querySelector("#service-price-" + id).innerText.split(' ');
                    var totalPriceElem = document.querySelector("#total-price");
                    totalPriceElem.innerText = "R$ " + (Number(totalPriceElem.innerText.split(' ')[1]) - Number(servicePrice[1])).toFixed(2);
                    document.querySelector("#service-container-" + id).remove();
                    document.querySelector("#service-line-" + id).remove();
                }
            } catch (error){
                console.log("erro");
                console.log(error);
                document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>' + error.response.data.messages.error + '</p></div></div>';
            }
        }

        async function Editar(){
            event.preventDefault();
            document.querySelector("#DialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"></div>';
            try {
                reservaData = document.querySelector('#service-name-' + target_id).innerText.split("/");
                reservaData = reservaData[2] + "-" + reservaData[1] + "-" + reservaData[0];
                var data;
                if(DataElem.value == reservaData){
                    data = {
                        "Usuario_id" : Usuario_idElem.value,
                        "Turno": TurnoElem.value    
                    };
                }else {
                    data = {
                        "Usuario_id" : Usuario_idElem.value,
                        "Data": DataElem.value,
                        "Turno": TurnoElem.value    
                    };
                }

                const res = await axios.post("/api/pedidos/" + target_id, data);
                if(res.status == 200){
                    console.log("Editado com sucesso.");
                    let reservaData = DataElem.value.split("-");
                    reservaData = reservaData[2] + "/" + reservaData[1] + "/" + reservaData[0];
                    document.querySelector("#service-name-" + target_id).innerText = reservaData;
                    document.querySelector("#service-shift-" + target_id).innerText = TurnoElem.value;
                    AlterarDialog.close();
                    Back.style.display = "none";
                }
            }catch (error){
                console.log(error);
                if(error.response.status == 500){
                    document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Ocorreu um erro interno.</p></div></div>';
                }else{
                    document.querySelector("#DialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"><div class="DialogMessage erro"><p>' + error.response.data.messages.error + '</p></div></div>';
                }
                        
                

                
            }
            
        }

        async function Pagar()
        {
            event.preventDefault();
            const Usuario_idElem = document.querySelector("#userId");
            try{
                const res = await axios.post("/api/payAll/" + Usuario_idElem.value);

                if(res.status == 200){
                    console.log("Todos os pedidos foram pagos");
                    document.querySelector("#info").innerHTML = '<div class="info"  id="info"></div>';
                    window.location.replace("/aluno/historico/")    ;
                }
                
            } catch( error ){
                document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Ocorreu um erro interno.</p></div></div>';
            }
        }
    </script>
</body>
</html>
