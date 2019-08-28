<?php
    // Classe de conexão ao banco de dados
    require_once('conexao.php');

    // Classe Clientes 
    require_once('../classes/Clientes.Class.php');

    Class CrudClientes {

        public static $conexao;

        private function __construct() {
            //-- Uso se necessário
        }

        public function Cadastrar(Clientes $cliente){

            try {
                $sql = "INSERT INTO t070_Clientes(
                        nomecli,
                        cnpj,
                        nomefant,
                        enderc,
                        numeroc,
                        complc,
                        cepc,
                        bairroc,
                        cidadec,
                        estadoc                       
                    )VALUES(
                        ?,?,?,?,?,?,?,?,?,?
                    )";

                $qry = ConexaoBD::getConexao()->prepare($sql);

                $qry->bindValue(1, $cliente->getRazaoSocial(), PDO::PARAM_STR);
                $qry->bindValue(2, $cliente->getCnpj());
                $qry->bindValue(3, $cliente->getNomeFantasia());
                $qry->bindValue(4, $cliente->getEnderCom());
                $qry->bindValue(5, $cliente->getEnderComNum());
                $qry->bindValue(6, $cliente->getenderComCompl());
                $qry->bindValue(7, $cliente->getEnderComCep());
                $qry->bindValue(8, $cliente->getEnderComBairro());
                $qry->bindValue(9, $cliente->getEndercomCidade());
                $qry->bindValue(10, $cliente->getEnderComUf());

                $qry->execute();

                return _MSG_CAD_002x01; // Cadastro efetuado com sucesso

            } catch (\Exception $th) {
                return $th->getMessage();
            }
        }

        public function ChecaDuplicado($cnpj){
            try {
                $sql = "SELECT 1 FROM t070_Clientes WHERE cnpj =?";
                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $cnpj);
                $qry->execute();

                if ( $qry->rowCount() > 0 ){ 
                    return _MSG_CAD_002x02;
                }else{
                    return 'OK';
                }

            } catch (\Throwable $th) {
                return $th->getMessage();
            }       
        } 

        public function Alterar(Clientes $cliente){
            try {
                $sql = "UPDATE t070_Clientes SET 
                            nomecli =?, 
                            nomefant=?, 
                            enderc  =?, 
                            numeroc =?, 
                            complc  =?, 
                            bairroc =?, 
                            cidadec =?, 
                            estadoc =?, 
                            cepc    =?
                        WHERE
                            codcli  =?
                ";
                
                $qry = ConexaoBD::getConexao()->prepare($sql);
  
                $qry->bindValue(1, $cliente->getRazaoSocial());
                $qry->bindValue(2, $cliente->getNomeFantasia());
                $qry->bindValue(3, $cliente->getEnderCom());
                $qry->bindValue(4, $cliente->getEnderComNum());
                $qry->bindValue(5, $cliente->getEnderComCompl());
                $qry->bindValue(6, $cliente->getEnderComBairro());
                $qry->bindValue(7, $cliente->getEnderComCidade());
                $qry->bindValue(8, $cliente->getEnderComUf());
                $qry->bindValue(9, $cliente->getEnderComCep());
                $qry->bindValue(10, $cliente->getCodCli());

                $qry->execute();

                return _MSG_UPD_001x01; // Cadastro alterado com sucesso

            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function Excluir($Codigo){
            try {
                $sql = "DELETE FROM t070_Clientes WHERE codcli=?";

                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $Codigo);
                $qry->execute();

                return _MSG_DEL_003x01;

            } catch (\Throwable $th) {
                return "Erro ao tentar excluir o registro informado" . $th->getMessage();
            }
        }

        public function Visualizar(){
            try {
                $sql = "SELECT * FROM t070_Clientes order by nomecli";
                $qry = ConexaoBD::getConexao()->Query($sql); 

                $clientes = array();
                
                foreach ($qry->fetchAll(PDO::FETCH_ASSOC) as $e){

                    $cliente = new Clientes; 
                    $cliente->setCodCli($e['codcli']); 
                    $cliente->setDataCad($e['datacad']);  
                    $cliente->setRazaoSocial($e['nomecli']);
                    $cliente->setNomeFantasia($e['nomefant']);
                    $cliente->setCnpj($e['cnpj']);
                    $cliente->setEnderCom($e['enderc']);
                    $cliente->setEnderComCep($e['cepc']);
                    $cliente->setEnderComNum($e['numeroc']);
                    $cliente->setEnderComCompl($e['complc']);
                    $cliente->setEnderComBairro($e['bairroc']);
                    $cliente->setEnderComCidade($e['cidadec']);
                    $cliente->setEnderComUf($e['estadoc']);

                    $clientes[] = $cliente;
                }                
                
                return $clientes;

            } catch (\Throwable $th) {
                return "Erro ao listar os dados. Erro: " . $th->getMessage();
            }
        }

        public function ListarPorCodigo($codcli){
            try{
                $sql = "SELECT * FROM t070_Clientes WHERE codcli =?";
                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $codcli);
                $qry->execute();

                $clientes = array();

                foreach ( $qry as $e ) {
                    $cliente = new Clientes;
                    $cliente->setCodCli($e['codcli']);
                    $cliente->setDataCad($e['datacad']);
                    $cliente->setRazaoSocial($e['nomecli']);
                    $cliente->setNomeFantasia($e['nomefant']);
                    $cliente->setCnpj($e['cnpj']);  
                    $cliente->setEnderComCep($e['cepc']);
                    $cliente->setEnderCom($e['enderc']);
                    $cliente->setEnderComNum($e['numeroc']);
                    $cliente->setEnderComCompl($e['complc']);
                    $cliente->setEnderComBairro($e['bairroc']);
                    $cliente->setEnderComCidade($e['cidadec']);
                    $cliente->setEnderComUf($e['estadoc']);                                    
                    $clientes[] = $cliente;

                    return $clientes;
                }

            }catch (\Throwable $th) {
                return "Erro ao listar os dados. Erro: " . $th->getMessage();
            }
        }      
    }   
?>