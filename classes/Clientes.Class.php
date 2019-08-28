<?php
    Class Clientes {

        private $codcli;
        private $datacad;
        private $razao_social;
        private $nome_fantasia;
        private $cnpj;
        private $ender_com;
        private $ender_com_num;
        private $ender_com_compl;
        private $ender_com_cep;
        private $ender_com_bairro;
        private $ender_com_cidade;
        private $ender_com_uf;

        public function getCodCli(){
            return $this->codcli;
        }

        public function setDataCad($datacad){
            $this->datacad = $datacad;
        }

        public function getDataCad(){
            return $this->datacad;
        }

        public function setCodCli($codcli){
            $this->codcli = str_pad($codcli, 5, 0, STR_PAD_LEFT);
        }

        public function getRazaoSocial(){
            return $this->razao_social;
        }  
        
        public function setRazaoSocial($razao_social){
            $this->razao_social = $razao_social;
        }

        public function getNomeFantasia(){
            return $this->nome_fantasia;
        }       

        public function setNomeFantasia($nome_fantasia){
            $this->nome_fantasia = $nome_fantasia;
        }

        public function getCnpj(){
            return preg_replace("/[^0-9]/", "", $this->cnpj);
        }    

        public function getCnpjFrmt(){
            return preg_replace('/([0-9]{2})([0-9]{3})([0-9]{3})([0-9]{4})([0-9]{2})/','$1.$2.$3/$4-$5', $this->cnpj);
        }
        public function setCnpj($cnpj){
            $this->cnpj = $cnpj;
        }

        public function getEnderCom(){
            return $this->ender_com;
        }  
        
        public function setEnderCom($ender_com){
            $this->ender_com = $ender_com;
        }

        public function getEnderComNum(){
            return $this->ender_com_num;
        }    
        
        public function setEnderComNum($ender_com_num){
            $this->ender_com_num = $ender_com_num;
        }

        public function getEnderComCompl(){
            return $this->ender_com_compl;
        }       

        public function setEnderComCompl($ender_com_compl){
            $this->ender_com_compl = $ender_com_compl;
        }

        public function getEnderComCep(){
            return preg_replace("/[^0-9]/", "", $this->ender_com_cep);
        }   

        public function getEnderComCepFrmt(){
            return preg_replace('/([0-9]{5})([0-9]{3})/','$1-$2', $this->ender_com_cep);
        }  
        
        public function setEnderComCep($ender_com_cep){
            $this->ender_com_cep = $ender_com_cep;
        }

        public function getEnderComBairro(){
            return $this->ender_com_bairro;
        }       

        public function setEnderComBairro($ender_com_bairro){
            $this->ender_com_bairro = $ender_com_bairro;
        }

        public function getEnderComCidade(){
            return $this->ender_com_cidade;
        }       

        public function setEnderComCidade($ender_com_cidade){
            $this->ender_com_cidade = $ender_com_cidade;
        }

        public function getEnderComUf(){
            return $this->ender_com_uf;
        }       

        public function setEnderComUf($ender_com_uf){
            $this->ender_com_uf = $ender_com_uf;
        }

    }
?>