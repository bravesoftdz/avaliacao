<?php
  session_start();

  // Cria a variavel de sessão do Código do Cliente caso não exista
  if ( !isset($_SESSION['CodigoCli']) ){

    if ( isset($_REQUEST['codcli']) ) {
      $_SESSION['CodigoCli'] = $_REQUEST['codcli'];
    }else{
      header('Location: ../clientes/index.php');
    }

  }

  // Classe CrudContatos
  require_once('../db/SqlContatos.Crud.php'); 
  
  // Classe CrudContatos
  require_once('../db/SqlClientes.Crud.php');

  // Carrega a razão e cnpj do clietne selecionado
  $cliente = CrudClientes::ListarPorCodigo($_SESSION['CodigoCli']);
  
  foreach ($cliente as $c) {
    echo $c->getRazaoSocial();
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

  <title>Lista de Contatos</title>

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
      <div class="input-group">
        <div class="input-group-append">
        </div>
      </div>
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
      <li class="nav-item active">
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
          <h6 class="dropdown-header">Contatos:</h6>
          <a class="dropdown-item" href="FormContatos.php?action=inc">Cadastrar Contatos</a>
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
        
        <header class="cli-select">
            <span>Cliente: </span> 
            <span><?php echo $c->getRazaoSocial() ?> / <?php echo $c->getCnpjFrmt(); ?> </span>
        </header>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Contatos Cadastrados              
            </div>
            
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="lsContatos" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>Fone Fixo</th>
                      <th>Celular</th>
                      <th>E-mail</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>Fone Fixo</th>
                      <th>Celular</th>
                      <th>E-mail</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    /**
                      *  recupera os dados e apresenta na tela
                      */
                    $lst = CrudContatos::Visualizar($_SESSION['CodigoCli']);
                    foreach( $lst as $e ) {
                      ?>
                      <tr>
                          <td><?php echo $e->getNroCto(); ?></td>
                          <td><?php echo $e->getNomeContato(); ?></td>
                          <td><?php echo $e->getFone1Frmt(); ?></td>
                          <td><?php echo $e->getFone2Frmt(); ?></td>
                          <td><?php echo $e->getEmail(); ?></td>
                          <td><center>
                              <a href="formContatos.php?action=alt&nrocto=<?php echo $e->getNroCto(); ?>" class="btn btn-primary btn-sm"><span class="fas fa-pen"></span> Alterar</a>
                              <a href="#" value="<?php echo $e->getNroCto();?>" class="btn btn-danger btn-sm" id="alExcluir"><span class="far fa-trash-alt"></span> Excluir</a>
                          </center>
                          </td>
                      </tr>
                      <?php
                    }

                ?>
                </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted" id="infCliente">by Winston Moreira</div>
        </div>

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
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

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

  <script>
    $('#lsContatos').dataTable({
      order : [1, "asc"],

      columnDefs: [{
        width : "1%",
        targets : 0
      },{
        width : "27%",
        targets : 1
      },{
        width : "12%",
        targets : [2,3]
      },{
        width : "27%",
        targets : 4
      },{
        orderable: false,
        targets: [4,4,5]
      }]
    });

    // Confirma se envia ou não
    $(document).ready(function(){

      // Variável para receber e tratar todos os eventos
      var request;

      // Captura o formulário responsável pelo evento
      $("a#alExcluir").click(function(event){

        if (confirm('Tem certeza que deseja excluir etse registro?')){

          // Cancela eventos pendentes
          if (request) {
              request.abort();
          }

          // Define a varivel como local
          var sCodigoCto = $(this).attr('value')

          // Envia os dados do formulário para serem processados
          request = $.ajax({
              url: "core.php",
              type: "get",
              data: {
                  action: 'del', 
                  CodigoCli : <?php echo $_SESSION['CodigoCli'] ?>,
                  CodigoCto : sCodigoCto
              }
          });

          // Processa e recebe e trata o retorno
          request.done(function (response, textStatus, jqXHR){
          switch (response) {
              case '003x01' :
                  alert('Registro excluido com sucesso.');
              
                  // redireciona a página
                  window.location.href = "index.php";
              break;
              
              case '003x02':
                  alert('Erro ao excluir o registro selecionado.');
              
                  // redireciona a página
                  window.location.href = "index.php";
              break;

              default:
                  alert(response);
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
        }
      });
    },false);

  </script>
</body>

</html>
