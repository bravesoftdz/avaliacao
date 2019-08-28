<?php
  session_start();

  // Classe funções para o banco de dados
  require_once('../db/SqlClientes.Crud.php');

  
  if ( $_SERVER['REQUEST_METHOD'] == "GET" ){

    // Se não vir do formulário de clientes
    if ( !isset($_REQUEST['action']) ) {
      header('Location: index.php');
    }else{

      if ( $_REQUEST['action'] == 'alt' ){
        $cliente = CrudClientes::ListarPorCodigo($_REQUEST['ID_Cliente']);
          
        foreach ($cliente as $lst){
          //
        }
      }
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

  <title>Cadastro de Clientes</title>

  <!-- Custom fonts for this template-->
  <link href="../includes/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../includes/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../includes/css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Cadastro de Clientes</a>

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
          <h6 class="dropdown-header">Cadastros diversos</h6>
          <a class="dropdown-item" href="index.php">Clientes</a>
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
          <li class="breadcrumb-item active">Cadastrar</li>
        </ol>

        <!-- content -->
        <div class="container">
          <header class="row">
            <br />
          </header>

          <article>
            <form name="clientes" class="form-horizontal" autocomplete="off">
              <div class="panel panel-default">

              <input type="hidden" name="Codigo" value="<?php echo (isset($_REQUEST['ID_Cliente'])) ? $_REQUEST['ID_Cliente'] : '' ?>">
              <input type="hidden" name="action" value="<?php echo $_REQUEST['action']; ?>">
              
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="RazaoSocial">Razão Social</label>
                    <input name="RazaoSocial" type="text" class="form-control" id="RazaoSocial" placeholder="Empresa teste" value="<?php 
                          echo ( isset( $lst ) && ( $lst->getRazaoSocial() != "") ) ? $lst->getRazaoSocial() : '' 
                      ?>" required>
                  </div>
                  <div class="form-group col-md-4">
                    <label for="NomeFantasia">Nome Fantasia</label>
                    <input name="NomeFantasia" type="text" class="form-control" id="NomeFantasia" placeholder="" value="<?php 
                          echo (isset( $lst ) && ( $lst->getNomeFantasia() != "" ) ) ? $lst->getNomeFantasia() : '' 
                      ?>" required>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="Cnpj">Cnpj</label>
                    <input name="Cnpj" type="text" class="form-control" id="Cnpj" placeholder="00.000.000/0000-00" value="<?php 
                          echo ( isset( $lst ) && ( $lst->getCnpjFrmt() != "") ) ? $lst->getCnpjFrmt() : '' 
                      ?>" onkeyup="RemoverFormatacao(this)" onblur="FormatCNPJ(this)" required
                      
                      <?php echo (isset($lst)) ? "disabled" : '' ?> maxlength="14">
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-sm-2">
                    <label for="EnderComCep">Cep</label>
                    <input name="EnderComCep" type="text" class="form-control" id="EnderComCep" placeholder="00000-000" value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderComCepFrmt() != "")) ? $lst->getEnderComCepFrmt() : ''
                    ?>" onkeyup="RemoverFormatacao(this)" onblur="FormatCEP(this)" maxlength="8">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="EnderCom">Endereço</label>
                    <input name="EnderCom" type="text" class="form-control" id="EnderCom" placeholder="" value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderCom() != "") ) ? $lst->getEnderCom() : ''; 
                    ?>">
                  </div>
                  <div class="form-group col-md-1">
                    <label for="EnderComNum">N.º</label>
                    <input name="EnderComNum" type="text" class="form-control" id="EnderComNum" placeholder="0000" value="<?php
                      echo ( isset( $lst ) && ($lst->getEndercomNum() != "")) ? $lst->getEnderComNum() : ''
                    ?>">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="EnderComCompl">Complemento</label>
                    <input name="EnderComCompl" type="text" class="form-control" id="EnderComCompl" placeholder="Casa, Apto, Conj." value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderComCompl() != "") ) ? $lst->getEnderComCompl() : ''
                    ?>">
                  </div>
                </div>

                <div class="form-row">

                  <div class="form-group col-sm-5">
                    <label for="EnderComBairro">Bairro</label>
                    <input name="EnderComBairro" type="text" class="form-control" id="EnderComBairro" placeholder="" value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderComBairro() != "")) ? $lst->getEnderComBairro() : ''
                    ?>">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="EnderComCidade">Cidade</label>
                    <input name="EnderComCidade" type="text" class="form-control" id="EnderComCidade" placeholder="" value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderComCidade() != "")) ? $lst->getEnderComCidade() : ''
                    ?>">
                  </div>

                  <div class="form-group col-md-1">
                    <label for="EnderComUf">UF</label>
                    <input name="EnderComUf" type="text" class="form-control" id="EnderComUf" placeholder="" value="<?php
                      echo ( isset( $lst ) && ($lst->getEnderComUf() != "")) ? $lst->getEnderComUf() : ''
                    ?>">
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
            <span>Cadastro de Clientes</span>
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
  
  <!-- Validador de cnpj -->
  <script src="../includes/js/valida.cnpj.js"></script>

  <!-- Formatação dos campos Cnpj, Cpf e Cep -->
  <script>

    function RemoverFormatacao(Input){
      if (event.key != 'Tab')
        Input.value = Input.value.replace(/([a-zA-Z]|\/|\-|\+|\*)/g,"");
    }

    // Formata o campo para cpf ou cnpj
    function FormatCNPJ(cnpjCPO){
      if ( cnpj(cnpjCPO) == false ) {

        alert('Cnpj informado não é válido.');
        cnpjCPO.value = '';
        cnpjCPO.focus();

      }else{
        
        if ( (cnpjCPO.value.length > 0 ) && (cnpjCPO.value.length < 14)) {
          cnpjCPO.value = '';
        }else{
          cnpjCPO.value = cnpjCPO.value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g,"\$1.\$2.\$3\/\$4\-\$5");
        }

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
        var form = $(this);

        // Lista todos os objetos do form
        var inputs = form.find("input, select, button, textarea");

        var serializedData = form.serialize();

        // Desabilita os objetos enquanto durar o envio.
        inputs.prop("disabled", true);

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
            inputs.prop("disabled", false);
        });

    });
  </script> 
</body>

</html>
