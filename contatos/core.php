<?php
    session_start();
    
    // Classe funções para o banco de dados
    require_once('../db/SqlContatos.Crud.php');

    // Classe cliente
    require_once('../classes/Contatos.Class.php');

    // Msgs do sistema
    require_once('../includes/msgs.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if ( $_REQUEST['action'] == 'del' )
            echo( $retExcluir = CrudContatos::Excluir($_SESSION['CodigoCli'], $_REQUEST['CodigoCto']) );

    }else{
        // Checa o tipo de requisição
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Verifica se alteração ou inclusão
            if ($_REQUEST['action'] == 'alt'){
                                
                $clsAlterar = new Contatos;
                $clsAlterar->setNomeContato(filter_input(INPUT_POST, 'NomeContato'));
                $clsAlterar->setFone1(filter_input(INPUT_POST, 'Fone1'));
                $clsAlterar->setFone2(filter_input(INPUT_POST, 'Fone2'));
                $clsAlterar->setEmail(filter_input(INPUT_POST, 'Email'));
                $clsAlterar->setEmail2(filter_input(INPUT_POST, 'Email2'));
                $clsAlterar->setObservacoes(filter_input(INPUT_POST, 'Observacoes'));
                
                echo $retGravar = CrudContatos::Alterar($clsAlterar);
            }

            if ( $_REQUEST['action'] == 'inc'){
                $clsCadastrar = new Contatos;
                $clsCadastrar->setNomeContato(filter_input(INPUT_POST, 'NomeContato'));
                $clsCadastrar->setFone1(filter_input(INPUT_POST, 'Fone1'));
                $clsCadastrar->setFone2(filter_input(INPUT_POST, 'Fone2'));
                $clsCadastrar->setEmail(filter_input(INPUT_POST, 'Email'));
                $clsCadastrar->setEmail2(filter_input(INPUT_POST, 'Email2'));
                $clsCadastrar->setObservacoes(filter_input(INPUT_POST, 'Observacoes'));

                echo $retGravar = CrudContatos::Cadastrar($clsCadastrar);
            }

        }else{
            Header('Location: ../index.php');
        }
    }
?>