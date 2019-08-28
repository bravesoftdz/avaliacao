<?php
    Class ConexaoBD {

        private static $host        = "localhost";
        private static $port        =  5432;
        private static $database    = "postgres";
        private static $user        = "postgres";
        private static $passwd      = "j2169777";        

        public static $conexao;

        private function __construct(){
            //
        }

        public static function getConexao(){
            $sDsn = sprintf("pgsql:host=%s;port=%s;dbname=%s;user=%s;password=%s",
                        self::$host,
                        self::$port,
                        self::$database,
                        self::$user,
                        self::$passwd
                    );

            if( !isset( self::$conexao ) ){

                // Efetua a conexão com a base de dados
                try {
                    self::$conexao = new PDO($sDsn);
                    self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    self::$conexao->exec("set names 'utf8'");
                } catch (\PDOException $erro) {
                    echo "<p class=\"bg-danger\">Erro na conexão:" . $erro->getMessage() . "</p>";
                }
            }
            
            return self::$conexao;
        }
    }
?>