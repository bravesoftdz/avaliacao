<?php
    
    // Classe de conexão ao banco de dados
    require_once('conexao.php');

    // Classe Clientes 
    require_once('../classes/Contatos.Class.php');

    Class CrudContatos {

        public static $conexao;

        private function __construct() {
            //-- Uso se necessário
        }

        public function Cadastrar(Contatos $contato){

            try {
                $sql = "INSERT INTO t071_Clientes_Contatos(
                        nomecont,
                        telefone1,
                        telefone2,
                        email,
                        email2,
                        observacoes,
                        codcli                       
                    )VALUES(
                        ?,?,?,?,?,?,?
                    )";

                $qry = ConexaoBD::getConexao()->prepare($sql);

                $qry->bindValue(1, $contato->getNomeContato(), PDO::PARAM_STR);
                $qry->bindValue(2, $contato->getFone1());
                $qry->bindValue(3, $contato->getFone2());
                $qry->bindValue(4, $contato->getEmail());
                $qry->bindValue(5, $contato->getEmail2());
                $qry->bindValue(6, $contato->getObservacoes());
                $qry->bindValue(7, $_SESSION['CodigoCli']);
                $qry->execute();

                return _MSG_CAD_002x01; // Cadastro efetuado com sucesso

            } catch (\Exception $th) {
                return $th->getMessage();
            }
        }

        public function Alterar(Contatos $contatos){
            try {
                $sql = "UPDATE t071_Clientes_Contatos SET 
                            nomecont    =?, 
                            telefone1   =?, 
                            telefone2   =?, 
                            email       =?, 
                            email2      =?, 
                            observacoes =?
                        WHERE
                            nrocto      =?
                        AND
                            codcli      =?
                ";
                
                $qry = ConexaoBD::getConexao()->prepare($sql);
  
                $qry->bindValue(1, $contatos->getNomeContato());
                $qry->bindValue(2, $contatos->getFone1());
                $qry->bindValue(3, $contatos->getFone2());
                $qry->bindValue(4, $contatos->getEmail());
                $qry->bindValue(5, $contatos->getEmail2());
                $qry->bindValue(6, $contatos->getObservacoes());
                $qry->bindValue(7, $_SESSION['CodigoCto']);
                $qry->bindValue(8, $_SESSION['CodigoCli']);

                $qry->execute();

                return _MSG_UPD_001x01; // Cadastro alterado com sucesso

            } catch (\Throwable $th) {
                return $th->getMessage();
            }
        }

        public function Excluir($sCodigoCli, $sCodigoCto){
            try {
                $sql = "DELETE FROM t071_Clientes_Contatos WHERE codcli =? AND nrocto =?";

                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $sCodigoCli);
                $qry->bindValue(2, $sCodigoCto);
                $qry->execute();

                return _MSG_DEL_003x01;

            } catch (\Throwable $th) {
                return "Erro ao tentar excluir o registro informado" . $th->getMessage();
            }
        }

        public function Visualizar($sCodigoCli){
            try {
                $sql = "SELECT * FROM t071_Clientes_Contatos WHERE codcli =? order by nomecont";
                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $sCodigoCli);
                $qry->execute();

                $contatos = array();
                
                foreach ($qry->fetchAll(PDO::FETCH_ASSOC) as $e){

                    $contato = new Contatos; 
                    $contato->setCodCli($e['codcli']);
                    $contato->setNroCto($e['nrocto']);
                    $contato->setNomeContato($e['nomecont']);
                    $contato->setFone1($e['telefone1']);
                    $contato->setFone2($e['telefone2']);
                    $contato->setEmail($e['email']);
                    $contatos[] = $contato;
                }                
                
                return $contatos;

            } catch (\Throwable $th) {
                return "Erro ao listar os dados. Erro: " . $th->getMessage();
            }
        }

        public function ListarPorCodigo($sCodigoCli, $sCodigoCto){
            try{
                $sql = "SELECT * FROM t071_Clientes_Contatos WHERE codcli =? and nrocto =?";
                $qry = ConexaoBD::getConexao()->prepare($sql);
                $qry->bindValue(1, $sCodigoCli);
                $qry->bindValue(2, $sCodigoCto);
                $qry->execute();
                
                $contatos = array();

                foreach ( $qry as $e ) {
                    $contato = new Contatos;
                    $contato->setCodCli($e['codcli']);
                    $contato->setNroCto($e['nrocto']);
                    $contato->setNomeContato($e['nomecont']);
                    $contato->setFone1($e['telefone1']);
                    $contato->setFone2($e['telefone2']);
                    $contato->setEmail($e['email']);
                    $contato->setObservacoes($e['observacoes']);
                    $contatos[] = $contato;
            
                    return $contatos;
                }

            }catch (\Throwable $th) {
                return "Erro ao listar os dados. Erro: " . $th->getMessage();
            }
        }      
    }   
?>