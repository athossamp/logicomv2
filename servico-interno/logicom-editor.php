<?php
require "../config.php";
session_start();
if (!isset($_SESSION["loggedin"])) {
  exit;
}
$sqlEditKanban = 'SELECT * FROM Tarefas_Kanban WHERE idTarefa = "' . $_GET['idTarefa'] . '"';

$resultEditKanban = $conection_db->query($sqlEditKanban);
$dataEditKanban = $resultEditKanban->fetch_assoc();

$sqlSelect = 'SELECT * FROM LOGICOM_ROTINA ORDER BY LGRROTINA';
$resultSelect = $conection_db->query($sqlSelect);
if ($resultSelect->num_rows > 0) {
  $dataSelect = mysqli_fetch_all($resultSelect, MYSQLI_ASSOC);
}
$sqlSelectRotina = 'SELECT * FROM LOGICOM_ROTINA WHERE LGRROTINA = "' . $dataEditKanban['Rotina'] . '"';
$resultSelectRotina = $conection_db->query($sqlSelectRotina);
$dataSelectRotina = $resultSelectRotina->fetch_assoc();

$sqlSelectProjeto = 'SELECT * FROM Projeto_Kanban';
$resultSelectProjeto = $conection_db->query($sqlSelectProjeto);
if($resultSelectProjeto->num_rows > 0) {
  $dataSelectProjeto = mysqli_fetch_all($resultSelectProjeto, MYSQLI_ASSOC);
}

$sqlSelectUsuario = 'SELECT * FROM Usuario_Kanban';
$resultSelectUsuario = $conection_db->query($sqlSelectUsuario);
if($resultSelectUsuario->num_rows > 0) {
  $dataSelectUsuario = mysqli_fetch_all($resultSelectUsuario, MYSQLI_ASSOC);
}
$sqlSelectProjetoSelecionado = "SELECT * FROM Projeto_Kanban WHERE idProjeto = '". $dataEditKanban['idProjeto'] ."'";
$resultSelectProjetoSelecionado = $conection_db->query($sqlSelectProjetoSelecionado);
$dataSelectProjetoSelecionado = $resultSelectProjetoSelecionado->fetch_assoc();
?>

<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="logicom-cadastro.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet" />
  </head>

  <body>
    <header>
      <div class="header">
        <div class="header-left">
          <a href="index.html"><img src="../images/logo.svg" style="height: 90px" /></a>
          <div class="header-right">
            <a class="inicio" href="index.html">Home</a>
            <a class="inicio" href="produtos.html">Produtos</a>
            <div class="dropdown">
              <button class="inicio dropbtn">
                Segmentos
              </button>
              <div class="dropdown-content">
                <a href="mercado.html">Mercado</a>
                <a href="hotelaria.html">Hotelaria</a>
                <a href="restaurante.html">Restaurante</a>
              </div>
            </div>
            <a class="inicio" href="gestao.html">Gestão</a>
            <a class="inicio" href="contato.html">Contato</a>
            <div class="highlight-inicio">
              <a class="cliente" href="login.php">Area do cliente
                <hr class="selected-link" />
              </a>
            </div>
          </div>
        </div>
      </div>
      <button id="burgerButton" class="burger-button" type="button">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </button>

      <div id="burgerMenu" class="burger-menu hidden">
        <ul class="nav-items">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="produtos.html">Produtos</a></li>
          <li class="nav-item"><a class="nav-link" href="mercado.html">Mercado</a></li>
          <li class="nav-item"><a class="nav-link" href="hotelaria.html">Hotelaria</a></li>
          <li class="nav-item"><a class="nav-link" href="restaurante.html">Restaurante</a></li>
          <li class="nav-item"><a class="nav-link" href="gestao.html">Gestão</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Registro</a></li>
      </div>
    </header>
    <main>
      <div class="main-form">
        <h1>Cadastro de atividades</h1>
        <form method="post" action="logicom-editor-update.php">
          <!--todo: atrelar isso ao banco de dados-->
          <label class="cadastro-input-title">Id</label>
          <input name="paramIdTarefa" value="<?php echo $_GET['idTarefa'] ?>" class="cadastro-input" readonly />
          <label class="cadastro-input-title">Titulo</label>
          <input name="paramTitulo" value="<?php echo utf8_encode($dataEditKanban['Titulo']); ?>"
            class="cadastro-input" />
          <label class="cadastro-input-title">Resumo</label>
          <textarea name="paramLegenda" value="<?php echo $dataEditKanban['Legenda'] ?>"
            class="cadastro-input"><?php echo utf8_encode($dataEditKanban['Legenda']) ?></textarea>
          <label class="cadastro-input-title">Descrição</label>
          <textarea name="paramDescricao" value="<?php echo $dataEditKanban['Descricao'] ?>"
            class="cadastro-input"><?php echo utf8_encode($dataEditKanban['Descricao']) ?></textarea>
          <!--Escolher nome do funcionario p/ atribuicao-->
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <label class="cadastro-input-title">Atribuição</label>
          <select name="paramAtribuicao" class="tarefas-filtro-select">
          <?php 
              $sqlSelectKanbanUsuarioAtribuido = "SELECT * FROM Usuario_Kanban WHERE IdUsuario = '". $dataEditKanban['idAtribuicao'] ."'";
              $resultKanbanUsuarioAtribuido = $conection_db->query($sqlSelectKanbanUsuarioAtribuido);
              $dataKanbanUsuarioAtribuido = $resultKanbanUsuarioAtribuido->fetch_assoc();
              echo utf8_encode($dataKanbanUsuarioAtribuido['Nome']) ?>
            </option>
            <?php foreach($dataSelectUsuario as $resultProjeto) { ?>
                <option value=<?php echo $resultProjeto['IdUsuario'] ?> >
                  <?php echo $resultProjeto['Nome'] ?>
                </option>
              <?php }?>
          </select>
          <!--TODO: Mudar isso pra um sistema de select option com os usuarios do kanban-->
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <label class="cadastro-input-title">Rotina</label>
          <select id="standard-select" name="paramRotina" id="filtroStatus" class="tarefas-filtro-select">
            <option value="<?php echo $dataEditKanban['Rotina'] ?>">
              <?php echo $dataEditKanban['Rotina'], ' - ', utf8_encode($dataSelectRotina['LGRDESCRICAO']) ?>
            </option>
            <?php
            foreach ($dataSelect as $resultSelectData) {
              ?>

              <option value=<?php echo $resultSelectData['LGRROTINA'] ?> required>
                <?php echo $resultSelectData['LGRROTINA'], ' - ', utf8_encode($resultSelectData['LGRDESCRICAO']) ?>
              </option>
            <?php } ?>
          </select>
          <label class="cadastro-input-title">Estado de Desenvolvimento</label>
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <select id="selectOption" name="paramEstado" class="tarefas-filtro-select">
            <option value='1' <?php if($dataEditKanban['idEstado'] == '1') echo 'selected';  ?> >Aberto</option>
            <option value='2' <?php if($dataEditKanban['idEstado'] == '2') echo 'selected';  ?> >Desenvolvimento</option>
            <option value='3' <?php if($dataEditKanban['idEstado'] == '3') echo 'selected';  ?> >Finalizada</option>
          </select>
          <!--Requerente = usuario que cadastrou-->
          <label class="cadastro-input-title">Prioridade</label>
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <select name="paramIdPrioridade" class="tarefas-filtro-select">
            <option value='1' <?php if($dataEditKanban['idPrioridade'] == '1') echo 'selected';  ?> >Alta</option>
            <option value='2' <?php if($dataEditKanban['idPrioridade'] == '2') echo 'selected';  ?> >Media</option>
            <option value='3' <?php if($dataEditKanban['idPrioridade'] == '3') echo 'selected';  ?> >Baixa</option>
          </select>
          <label class="cadastro-input-title">Categoria</label>
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <select name="paramIdCategoria" class="tarefas-filtro-select">
            <option value='1' <?php if($dataEditKanban['idCategoria'] == '1') echo 'selected';  ?> >Mobile</option>
            <option value='2' <?php if($dataEditKanban['idCategoria'] == '2') echo 'selected';  ?> >Desktop</option>
            <option value='3' <?php if($dataEditKanban['idCategoria'] == '3') echo 'selected';  ?> >Web</option>
          </select>

          <label class="cadastro-input-title">Projeto</label>
          <!--Adicionar um select que busque qual valor ta sendo utilizado no banco de dados-->
          <select name="paramIdProjeto" class="tarefas-filtro-select">
          <option value="<?php echo $dataSelectProjetoSelecionado['idProjeto'] ?>">
              <?php 
              
              echo utf8_encode($dataSelectProjetoSelecionado['Titulo']) ?>
            </option>
            <option>Sem projeto</option>
            <?php foreach($dataSelectProjeto as $resultProjeto) { ?>
                <option value=<?php echo $resultProjeto['idProjeto'] ?> >
                  <?php echo $resultProjeto['Titulo'] ?>
                </option>
              <?php }?>
          </select>
          <button type="submit" class="button-submit tarefas">Salvar</button>
        </form>
      </div>
    </main>
    <div class="ver-tarefas">
      <a href="logicom-tarefas.php"><button class="button-submit">Voltar</button></a>
    </div>
    <img class="onda-logicom" src="../../images/Logicom ondas.png" />
    <footer>
      <div class="footer">
        <div class="left-footer"><a href="index.html"><img src="../images/logo.svg" style="height: 60px" /></a></div>
        <div class="middle-footer">
          <a href="https://www.linkedin.com/company/logicom-tecnologia/mycompany/"><img
              src="../images/footer-linkedin.png" style="height: 60px" /></a>
          <a href="https://www.instagram.com/logicomtec/"><img src="../images/instagram-header.png"
              style="height: 60px" /></a>
          <a href="https://www.facebook.com/logicomtec"><img src="../images/facebook-header.png"
              style="height: 60px" /></a>
        </div>
        <div class="right-footer">Logicom © 2023</div>
      </div>
    </footer>
  </body>

</html>