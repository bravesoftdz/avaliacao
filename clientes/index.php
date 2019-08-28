<?php
  session_start();

  // Destroi as variaveis de sessões
  unset($_SESSION['CodigoCli']);
  unset($_SESSION['CodigoCto']);
  
  // Classe CrudClientes
  require_once('../db/SqlClientes.Crud.php');  
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
        <a class="nav-link" href="index.php">
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
          <h6 class="dropdown-header">Cadastros diversos:</h6>
          <a class="dropdown-item" href="FormClientes.php?action=inc">Cadastrar</a>
        </div>
      </li>

    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Clientes</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Clientes Cadastrados</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="lsClients" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Código</th>
                      <th>Data</th>
                      <th>Cliente</th>
                      <th>Cnpj</th>
                      <th>Endereço</th>
                      <th>Cep</th>
                      <th>UF</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Código</th>
                      <th>Data</th>
                      <th>Cliente</th>
                      <th>Cnpj</th>
                      <th>Endereço</th>
                      <th>Cep</th>
                      <th>UF</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    /**
                      *  recupera os dados e apresenta na tela
                      */

                    $lst = CrudClientes::Visualizar();
                    foreach( $lst as $e ) {
                        ?>
                        <tr>
                            <td><?php echo $e->getCodCli(); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($e->getDataCad())); ?></td>
                            <td><?php echo $e->getRazaoSocial(); ?></td>
                            <td><?php echo $e->getCnpjFrmt(); ?></td>
                            <td><?php echo $e->getEnderCom() . ', ' . $e->getEnderComNum();  ?></td>
                            <td><?php echo $e->getEnderComCepFrmt(); ?></td>
                            <td><?php echo $e->getEnderComUf() ?></td>
                            <td><center>
                                <a href="../contatos/index.php?codcli=<?php  echo $e->getCodCli(); ?>" class="btn btn-danger btn-sm" ><span class="far fa-user"></span> Contatos</a>
                                <a href="formClientes.php?action=alt&ID_Cliente=<?php echo $e->getCodCli(); ?>" class="btn btn-primary btn-sm"><span class="fas fa-pen"></span> Alterar</a>
                                <a href="#" value="<?php echo $e->getCodCli(); ?>" class="btn btn-danger btn-sm" id="alExcluir" ><span class="far fa-trash-alt"></span> Excluir</a>
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
            <div class="card-footer small text-muted">by Winston Moreira</div>
        </div>

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
    $('#lsClients').dataTable({
      order : [2, "asc"],

      columnDefs: [{
        width : "1%",
        targets : [0,1]
      },{
        width : "13%",
        targets : 3
      },{
        width : "8%",
        targets : 5
      },{
        width : "24%",
        targets : 7
      },{
        orderable: false,
        targets: [4,4,5,6,7]
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
          var $codigo = $(this).attr('value')

          // Envia os dados do formulário para serem processados
          request = $.ajax({
              url: "core.php",
              type: "get",
              data: {
                  action: 'del', 
                  Codigo : $codigo
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
