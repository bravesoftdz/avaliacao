<?php
  session_start();
  
  // Crud Clientes
  require_once('../db/SqlClientes.Crud.php');

  // Crud Contatos
  require_once('../db/SqlContatos.Crud.php');

  if ( $_SERVER['REQUEST_METHOD'] == "GET" ){

    if ( $_REQUEST['action'] == 'alt' ){
      
      // Gerar a variável de sessão (CodigoCto)
      $_SESSION['CodigoCto'] = $_REQUEST['nrocto'];
      
      // Carrega os dados do contato selecionado
      $contato = CrudContatos::ListarPorCodigo(
            $_SESSION['CodigoCli'],
            $_SESSION['CodigoCto']
        );
          
      foreach ($contato as $lst){
        //
      }
    }

    // Carrega a razão e cnpj do clietne selecionado
    $cliente = CrudClientes::ListarPorCodigo($_SESSION['CodigoCli']);
    
    foreach ($cliente as $c) {
      echo $c->getRazaoSocial();
    }

  }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Cadastro de Contatos</title>

  <!-- Custom fonts for this template-->
  <link href="../includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../includes/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../includes/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="../clientes/index.php">Cadastro de Clientes</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">

      <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">Configurações</a>
          <a class="dropdown-item" href="#">Log de Atividades</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Sair</a>
        </div>
      </li>
    </ul>

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../clientes/index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-folder"></i>
          <span>Menu</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Contatos</h6>
          <a class="dropdown-item" href="index.php">Lista de Contatos</a>
          <a class="dropdown-item" href="../clientes/index.php">Listar Clientes</a>
        </div>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="../clientes/index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Contatos</li>
        </ol>

        <!-- content -->
        <div class="container">
          <header class="cli-select">
            <span>Cliente: </span> 
            <span><?php echo $c->getRazaoSocial() ?> / <?php echo $c->getCnpjFrmt(); ?> </span>
          </header>

          <article>
            <form name="clientes" class="form-horizontal">
              <div class="panel panel-default">

              <input type="hidden" name="Codigo" value="<?php echo (isset($_REQUEST['ID_Cliente'])) ? $_REQUEST['ID_Cliente'] : '' ?>">
              <input type="hidden" name="action" value="<?php echo $_REQUEST['action']; ?>">
              
                <div class="form-row">
                  <div class="form-group col-md-8">
                    <label for="NomeContato">Nome</label>
                    <input name="NomeContato" type="text" class="form-control" id="NomeContato" placeholder="joão Antonio da Silva" value="<?php 
                        echo ( isset( $lst ) && ( $lst->getNomeContato() != "") ) ? $lst->getNomeContato() : '' 
                      ?>" required>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="Fone1">Fone 1</label>
                    <input name="Fone1" type="text" class="form-control" id="Fone1" placeholder="(00)0000-0000" value="<?php 
                          echo (isset( $lst ) && ( $lst->getFone1Frmt() != "" ) ) ? $lst->getFone1Frmt() : '' 
                      ?>" onkeyup="RemoverFormatacao(this)" onblur="FormataFONE(this)" required>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="Fone2">Fone 2</label>
                    <input name="Fone2" type="text" class="form-control" id="Fone2" placeholder="(00)0000-0000" value="<?php 
                          echo ( isset( $lst ) && ( $lst->getFone2Frmt() != "") ) ? $lst->getFone2Frmt() : '' 
                      ?>" onkeyup="RemoverFormatacao(this)" onblur="FormataFONE(this)" required 
                    >  
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-6">
                    <label for="Email">E-mail 1</label>
                    <input name="Email" type="text" class="form-control" id="EnderComCep" placeholder="email@email.com.br" value="<?php
                      echo ( isset( $lst ) && ($lst->getEmail() != "")) ? $lst->getEmail() : ''
                    ?>">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="Email2">E-mail 2</label>
                    <input name="Email2" type="text" class="form-control" id="Email2" placeholder="email@email.com.br" value="<?php
                      echo ( isset( $lst ) && ($lst->getEmail2() != "") ) ? $lst->getEmail2() : ''; 
                    ?>">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-12">
                    <label for="Observacoes">Observações</label>
                    <textarea name="Observacoes" id="Observacoes" cols="30" rows="8" class="form-control"><?php 
                      echo (isset( $lst ) && ($lst->getObservacoes() != null || $lst->getObservacoes() != "")) ? $lst->getObservacoes() : ''
                    ?></textarea>
                  </div>
                </div>

                <div class="panel-footer">
                  <div class="clearfix">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <div class="pull-left">
                        <a href="index.php" class="btn btn-primary btn-sm" ><span class="fa fa-arrow-left"></span> Voltar</a>
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <div class="pull-right">
                          <button type="reset" class="btn btn-danger btn-sm"><i class="fa fa-save"></i>  Limpar</button>
                          <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i>  Salvar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>

          </article>
          
      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Cadastro de Contatos</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../includes/vendor/jquery/jquery.min.js"></script>
  <script src="../includes/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../includes/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="../includes/vendor/datatables/jquery.dataTables.js"></script>
  <script src="../includes/vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../includes/js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../includes/js/demo/datatables-demo.js"></script>

  <!-- Formatação dos campos Cnpj, Cpf e Cep -->
  <script>
    function RemoverFormatacao(Input){
      if (event.key != 'Tab'){ 
        Input.value = Input.value.replace(/([a-zA-Z]|\/|\-|\+|\*)/g,"");}
    }

    // Formata o campo para cpf ou cnpj
    function FormataFONE(fone){
      if (fone.value.length < 11) {
        fone.value = fone.value.replace(/(\d{2})(\d{4})(\d{4})/g,"\($1)\$2-\$3");        
      }else{
        fone.value = fone.value.replace(/(\d{2})(\d{5})(\d{4})/g,"\($1)\$2-\$3");    
      }
    }

    // formata o campo para cep
    function FormatCEP(Cep){
      if (Cep.value.length <= 11) {
        Cep.value = Cep.value.replace(/(\d{5})(\d{3})/g,"\$1-\$2");    
      }
    } 

    // Variável para receber e tratar todos os eventos
    var request;

    // Captura o formulário responsável pelo evento
    $("form").submit(function(event){

        // Impede o evento padrão do form
        event.preventDefault();

        // Cancela eventos pendentes
        if (request) {
            request.abort();
        }
        
        // Define a varivel como local
        var $form = $(this);

        // Lista todos os objetos do form
        var $inputs = $form.find("input, select, button, textarea");

        var serializedData = $form.serialize();

        // Desabilita os objetos enquanto durar o envio.
        $inputs.prop("disabled", true);

        // Envia os dados do formulário para serem processados
        request = $.ajax({
            url: "core.php",
            type: "post",
            data : serializedData
        });

        // Processa e recebe e trata o retorno
        request.done(function (response, textStatus, jqXHR){
          switch (response) {
            case '001x01' :
              alert('Registro alterado com sucesso');
              
              // redireciona a página
              window.location.href = "index.php";
              break;
            
            case '001x02':
              alert('Registro alterado com sucesso');
              
              // redireciona a página
              window.location.href = "index.php";
              break;

              case '002x01' :
              alert('Cadastro efetuado com sucesso');
              
              // redireciona a página
              window.location.href = "index.php";
              break;
            
            case '002x02':
              alert('Cnpj já existe na base de dados.');
              break;
          
            default:
              alert('Erro ao acessar a base de dados');
              window.location.href = "index.php";
              break;
          }
        });

        // Se houver erro na resposta
        request.fail(function (jqXHR, textStatus, errorThrown){
            // Exibe um logo no console para análise
            console.error(
                "Erro ao processar a informação: " + textStatus, errorThrown
            );
        });

        // Ajusta o formulário independente do tipo de resposta
        request.always(function () {
            $inputs.prop("disabled", false);
        });

    });
  </script> 
</body>

</html>
