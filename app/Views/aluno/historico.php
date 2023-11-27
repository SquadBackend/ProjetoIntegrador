<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/historico.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Histórico</title>
</head>
<body>
    <div class="header">
        <a href="<?php echo site_url('aluno/', METHOD); ?>"><img class="chevron-left" src="/img/chevron-left.svg" alt=""></a>
        <span class="header title">HISTÓRICO</span>
    </div>
    <div class="main">
        <div id="back">
            <dialog id="corrigirDialog" class="MegaDialog">
                <header>
                    <p>Corrigir o pedido</p>
                </header>
                <article>
                <div class="DialogInfo"  id="DialogInfo"></div>
                    <div class="input-div">
                        <label for="date">Corrigir o dia:</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div class="input-div">
                        <label for="turno">Corrigir o turno:</label>
                        <select name="turno" id="turno">
                            <option value="almoço">Almoço</option>
                            <option value="jantar">Jantar</option>
                        </select>
                    </div>
                </article>
                <footer>
                    <input type="hidden" name="userId" id="userId" value="<?= session()->get('id'); ?>">
                    <button autofocus onclick="this.closest('dialog').close('cancel');document.querySelector('#back').style.display = 'none';">Cancelar</button>
                    <button onclick="Corrigir(event);">Corrigir</button>
                </footer>
            </dialog>
        </div>
        <div class="filter-box">
            <form action="" method="get">
                <input type="date" name="date" id="date" value="<?php if(isset($date)) {echo $date;} ?>" required>
                <button>Filtrar</button>
            </form>
            <button onclick="window.location.replace('<?= site_url('aluno/historico', METHOD); ?>');">Limpar</button>
        </div>
        <p class="main-title">O QUE VOCÊ PEDIU RECENTEMENTE</p>

        <div class="food-list">
            <?php if($reservas) : ?>
                <?php foreach($reservas as $reserva) : ?>
                <hr>
                <div class="food-container">
                    <div class="food-picture">
                        <img src="https://saude.abril.com.br/wp-content/uploads/2022/06/nutricao-comida-brasileiro-prato.png?w=680&resize=1200,800" alt="">
                    </div>
                    <div class="food-description">
                        <p class="food-message">Você pediu isso!</p>
                        <p id="food-name-<?= $reserva['id']; ?>" class="food-name"><?= $reserva['Turno']; ?></p>
                        <p id="food-date-<?= $reserva['id']; ?>" class="food-date"><?= date("d/m/Y", strtotime($reserva['Data']));  ?></p>
                        <?php if($reserva['Data'] == date("Y-m-d")) : ?>
                            <button onclick="MostrarCorrigir(<?= $reserva['id']; ?>)">Corrigir</button>
                        <?php endif ?>
                    </div>
                </div>
                <?php endforeach ?>
            <?php else : ?>
                <hr> 
                <p>Nenhuma reserva feita.</p>
            <?php endif ?>
        </div>
    </div>
    <script>

        var target_id;

        const Usuario_idElem = document.querySelector("#userId");
        const DataElem = document.querySelector("#date");
        const TurnoElem = document.querySelector("#turno");
        const Back = document.querySelector('#back');
        const CorrigirDialog = document.querySelector('#corrigirDialog');

        function MostrarCorrigir(id){
            Back.style.display = 'block';
            CorrigirDialog.showModal();
            target_id = id;
            TurnoElem.value = document.querySelector('#food-name-' + id).innerText;
            reservaData = document.querySelector('#food-date-' + id).innerText.split("/");
            reservaData = reservaData[2] + "-" + reservaData[1] + "-" + reservaData[0];
            DataElem.value = reservaData;
        }

        async function Corrigir(){
            event.preventDefault();
            document.querySelector("#DialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"></div>';
            try {
                reservaData = document.querySelector('#food-date-' + target_id).innerText.split("/");
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
                    console.log("Corrigido com sucesso.");
                    let reservaData = DataElem.value.split("-");
                    reservaData = reservaData[2] + "/" + reservaData[1] + "/" + reservaData[0];
                    document.querySelector("#food-date-" + target_id).innerText = reservaData;
                    document.querySelector("#food-name-" + target_id).innerText = TurnoElem.value;
                    CorrigirDialog.close();
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
    </script>           
</body>
</html>
