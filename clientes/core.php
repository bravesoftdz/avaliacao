<?php
    // Classe funções para o banco de dados
    require_once('../db/SqlClientes.Crud.php');

    // Classe cliente
    require_once('../classes/Clientes.Class.php');

    // Msgs do sistema
    require_once('../includes/msgs.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET'){

        if ( $_REQUEST['action'] == 'del' )
            echo( $excluir = CrudClientes::Excluir($_REQUEST['Codigo']));

    }else{
        // Checa o tipo de requisição
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            // Verifica se alteração ou inclusão
            if ($_REQUEST['action'] == 'alt'){
                
                $alterar = new Clientes;
                $alterar->setCodCli(filter_input(INPUT_POST, 'Codigo'));
                $alterar->setRazaoSocial(filter_input(INPUT_POST, 'RazaoSocial'));
                $alterar->setNomeFantasia(filter_input(INPUT_POST, 'NomeFantasia'));
                $alterar->setEnderCom(filter_input(INPUT_POST, 'EnderCom'));
                $alterar->setEnderComCep(filter_input(INPUT_POST, 'EnderComCep'));
                $alterar->setEnderComNum(filter_input(INPUT_POST, 'EnderComNum'));
                $alterar->setEnderComCompl(filter_input(INPUT_POST, 'EnderComCompl'));
                $alterar->setEnderComBairro(filter_input(INPUT_POST, 'EnderComBairro'));
                $alterar->setEnderComCidade(filter_input(INPUT_POST, 'EnderComCidade'));
                $alterar->setEnderComUf(filter_input(INPUT_POST, 'EnderComUf'));

                echo ( $gravar = CrudClientes::Alterar($alterar) );
            }

            if ( $_REQUEST['action'] == 'inc'){
                $cadastrar = new Clientes;
                $cadastrar->setRazaoSocial(filter_input(INPUT_POST, 'RazaoSocial'));
                $cadastrar->setNomeFantasia(filter_input(INPUT_POST, 'NomeFantasia'));
                $cadastrar->setCnpj(filter_input(INPUT_POST, "Cnpj"));
                $cadastrar->setEnderCom(filter_input(INPUT_POST, 'EnderCom'));
                $cadastrar->setEnderComCep(filter_input(INPUT_POST, 'EnderComCep'));
                $cadastrar->setEnderComNum(filter_input(INPUT_POST, 'EnderComNum'));
                $cadastrar->setEnderComCompl(filter_input(INPUT_POST, 'EnderComCompl'));
                $cadastrar->setEnderComBairro(filter_input(INPUT_POST, 'EnderComBairro'));
                $cadastrar->setEnderComCidade(filter_input(INPUT_POST, 'EnderComCidade'));
                $cadastrar->setEnderComUf(filter_input(INPUT_POST, 'EnderComUf'));
                
                // Checa se o cnpj ja se encontra cadastrado
                $gravar = CrudClientes::ChecaDuplicado($cadastrar->getCnpj());
                if ( $gravar == "OK"){
                    echo ( $gravar = CrudClientes::Cadastrar($cadastrar) );
                }else{
                    echo $gravar;
                }
            }

        }else{
            Header('Location: ../index.php');
        }
    }
?>