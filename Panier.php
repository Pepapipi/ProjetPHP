<?php
    class Panier{
        ///ATTRIBUTS
        private $m_nombreItems;
        private $m_items;


        ///METHODES
        // Constructeur
        function __construct(){
            $this->m_items = array();
            $this->m_nombreItems = 0;
        }

        public function addItem($disc){
            $this->m_items[$this->m_nombreItems] = $disc;
            $this->m_nombreItems ++;
        }

        public function delItem($indice){
            $this->m_nombreItems --;
            unset($this->m_items[$indice]);
        }

        public function getItems(){
            return $this->m_items;
        }
    }
?>