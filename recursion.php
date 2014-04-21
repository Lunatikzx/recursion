<?php
    class Human{
        private $_name;
        private $_dad; 
        private $_mom;


        function __construct( $name, Human $dad = null, Human $mom = null){
            $this->setName($name);
            $this->setDad($dad);
            $this->setMom($mom);
        }

        public function setName($name) {
            $this->_name = $name;
        }
        
        public function getName() {
            return $this->_name;
        }
        
        public function setDad($dad) {
            $this->_dad = $dad;
        }

        public function getDad() {
            return $this->_dad;
        }

        public function setMom($mom) {
            $this->_mom = $mom;
        }
                
        public function getMom() {
            return $this->_mom;
        }
        
        public function get_f_tree(Human $humans = null){
            $parent = null;
            $human = $humans == null ? $this : $humans;

            $mom = $human->getMom();
            $dad = $human->getDad();

            $parent.="<ul>";
            
            $parent .= "<li>".$human->getName()."</li>";
            if (!is_null($mom) || !is_null($dad) ){
                $parent.="<li>";
            
                if (!is_null($mom)){
                    $parent.= $human->get_f_tree($mom);
                } 
                if (!is_null($dad)){
                    $parent.= $human->get_f_tree($dad);
                } 
                $parent.="</li>";

            }

            $parent.="</ul>";
            return $parent;
        }

    }


    $adam = new Human('Adam'); 
    $eve  = new Human('Eve', $adam); 
    $bob  = new Human('Bob', $adam, $eve);
    $cain = new Human('Cain', $bob, $eve); 
   
    echo $cain->get_f_tree();
