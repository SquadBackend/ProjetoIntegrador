<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cardápio</title>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>
  <body>
    <div id="back">
      <dialog id="alterarDialog" class="MegaDialog">
          <header>
              <p>Alterar o cardapio</p>
          </header>
          <article>
            <div class="DialogInfo"  id="EditDialogInfo"></div>
            <div class="input-div">
                <label for="food">Editar o ingrediente:</label>
                <select name="food" id="food-edit">
                    <option value="carne_moida">Carne moída</option>
                    <option value="legume">Legume</option>
                    <option value="arroz">Arroz</option>
                    <option value="feijao">Feijão</option>
                    <option value="file_frango">Filé de frango</option>
                </select>
            </div>
          </article>
          <footer>
              <button autofocus onclick="this.closest('dialog').close('cancel');document.querySelector('#back').style.display = 'none';">Cancelar</button>
              <button onclick="Editar(event);">Editar</button>
          </footer>
      </dialog>
      <dialog id="novoDialog" class="MegaDialog">
          <header>
              <p>Novo ingrediente</p>
          </header>
          <article>
            <div class="DialogInfo"  id="NewDialogInfo"></div>
            <div class="input-div">
                <label for="food">Nome do ingrediente:</label>
                <select name="food" id="food-new">
                    <option value="carne_moida">Carne moída</option>
                    <option value="legume">Legume</option>
                    <option value="arroz">Arroz</option>
                    <option value="feijao">Feijão</option>
                    <option value="file_frango">Filé de frango</option>
                </select>
            </div>
          </article>
          <footer>
              <button autofocus onclick="this.closest('dialog').close('cancel');document.querySelector('#back').style.display = 'none';">Cancelar</button>
              <button onclick="Criar(event);">Criar</button>
          </footer>
      </dialog>
    </div>
    
    <nav class="menu">
      <a href="<?php echo site_url('cantina/', METHOD); ?>"
        ><img class="chevron-left" src="/img/chevron-left.svg" alt=""
      /></a>
      <span>Menu</span>
    </nav>
    <header>
      <img class="imagem" src="/img/Logo.jpeg" alt="logotipo" />
      <p class="cardapio">Cardápio do Dia</p>
    </header>
    <main>
      <?php foreach($comidas as $comida) : ?>
          <div class="alimento" id="alimento-<?= $comida['id']; ?>">
              <img id="comida-img-<?= $comida['id']; ?>" class="comida-img" src="/img/<?= $comida['Comida']; ?>.jpeg" alt="foto da comida" />
              <h2 id="food-name-<?= $comida['id']; ?>"><?php echo $comida['Texto']; ?></h2>
              <div class="functions">
                <button onclick="MostrarEditar(<?= $comida['id']; ?>);">Editar</button>
                <button onclick="Deletar(<?= $comida['id']; ?>);">Remover</button>
              </div>
              
          </div>
      <?php endforeach ?>
    </main>
    <footer class="main-footer">
      <a onclick="MostrarCriar();">Novo</a>
    </footer>
    <script>

        var target_id;

        const Back = document.querySelector('#back');

        const AlterarDialog = document.querySelector('#alterarDialog');
        const FoodEdit = document.querySelector('#food-edit');
        
        const NovoDialog = document.querySelector('#novoDialog');
        const FoodNew = document.querySelector('#food-new');

        function MostrarCriar(){
            Back.style.display = 'block';
            NovoDialog.showModal();
        }

        function MostrarEditar(id){
            Back.style.display = 'block';
            AlterarDialog.showModal();
            target_id = id;
        }

        async function Criar(){
            event.preventDefault();
            document.querySelector("#NewDialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"></div>';
            try {
                const res = await axios.post("/api/cardapio", {
                        "Comida" : FoodNew.value,
                        "Texto" : FoodNew.options[FoodNew.selectedIndex].text,
                });
                if(res.status == 201){
                    console.log("Criado com sucesso.");
                    console.log(res);
                    window.location.replace("/cantina/cardapio/");
                    NovoDialog.close();
                    Back.style.display = "none";
                }
            }catch (error){
                console.log(error);
                if(error.response.status == 500){
                    console.log("Ocorreu um erro 500");
                    document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Ocorreu um erro interno.</p></div></div>';
                }else{
                    document.querySelector("#NewDialogInfo").innerHTML = '<div class="DialogInfo"  id="NewDialogInfo"><div class="DialogMessage erro"><p>' + error.response.data.messages.error + '</p></div></div>';
                }
                
            }
        }

        async function Editar(){
            event.preventDefault();
            document.querySelector("#EditDialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"></div>';
            try {
                let foodName = document.querySelector("#food-name-" + target_id);

                if(foodName.innerText != FoodEdit.options[FoodEdit.selectedIndex].text){
                    const res = await axios.post("/api/cardapio/" + target_id, {
                        "Comida" : FoodEdit.value,
                        "Texto" : FoodEdit.options[FoodEdit.selectedIndex].text,
                    });
                    if(res.status == 200){
                        console.log("Editado com sucesso.");
                        document.querySelector("#food-name-" + target_id).innerText = FoodEdit.options[FoodEdit.selectedIndex].text;
                        document.querySelector("#comida-img-" + target_id).setAttribute("src", "/img/" + FoodEdit.value + ".jpeg");
                        AlterarDialog.close();
                        Back.style.display = "none";
                    }    
                }else{
                    AlterarDialog.close();
                    Back.style.display = "none";
                }        

                
            }catch (error){
                console.log(error);
                if(error.response.status == 500){
                    console.log("Ocorreu um erro 500");
                    document.querySelector("#info").innerHTML = '<div class="info"  id="info"><div class="message erro"><p>Ocorreu um erro interno.</p></div></div>';
                }else{
                    document.querySelector("#EditDialogInfo").innerHTML = '<div class="DialogInfo"  id="DialogInfo"><div class="DialogMessage erro"><p>' + error.response.data.messages.error + '</p></div></div>';
                }
                
            }
        }

        async function Deletar(id){
            event.preventDefault();
            try {
                const res = await axios.delete("/api/cardapio/" + id);
                if(res.status == 200){
                    console.log("deletado com sucesso.");
                    document.querySelector("#alimento-" + id).remove();
                }
            } catch (error){
                console.log("erro");
                console.log(error);
            }
        }

    </script>
  </body>
</html>