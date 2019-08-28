<?php
    Class Contatos {

        private $codigoCli;
        private $nrocto;
        private $nomeContato;
        private $fone1;
        private $fone2;
        private $email;
        private $email2;
        private $observacoes;

        public function setCodCli($codigoCli){
            $this->codigoCli = $codigoCli;
        }

        public function getCodCli(){
            return $this->codigoCli;
        }

        public function setNroCto($nrocto){
            $this->nrocto = $nrocto;
        }

        public function getNroCto(){
            return $this->nrocto;
        }

        public function setNomeContato($nomeContato){
            $this->nomeContato = $nomeContato;
        }

        public function getNomeContato(){
            return $this->nomeContato;
        }

        public function setFone1($fone1){
            $this->fone1 = $fone1;
        }

        public function getFone1(){
            return $this->fone1;
        }

        public function getFone1Frmt(){
            if ( strlen($this->fone1 ) <= 10){
                return preg_replace('/([0-9]{2})([0-9]{4})([0-9]{4})/','($1)$2-$3', $this->fone1);
            }else{
                return preg_replace('/([0-9]{2})([0-9]{5})([0-9]{4})/','($1)$2-$3', $this->fone1);                
            }
        }

        public function setFone2($fone2){
            $this->fone2 = $fone2;
        }

        public function getFone2(){
            return $this->fone2;
        }
        
        public function getFone2Frmt(){
            if ( strlen($this->fone2 ) <= 10){
                return preg_replace('/([0-9]{2})([0-9]{4})([0-9]{4})/','($1)$2-$3', $this->fone2);
            }else{
                return preg_replace('/([0-9]{2})([0-9]{5})([0-9]{4})/','($1)$2-$3', $this->fone2);                
            }
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail2($email2){
            $this->email2 = $email2;
        }

        public function getEmail2(){
            return $this->email2;
        }

        public function setObservacoes($observacoes){
            $this->observacoes = $observacoes;
        }

        public function getObservacoes(){
            return $this->observacoes;
        }

    }
?>