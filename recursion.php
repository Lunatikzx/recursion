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

        public function get_f_tree(Human $human = null){
            $childs = null; 
            $parent = null;
            $human = $human == null ? $this : $human;
            
            $mom = $human->getMom();
            $dad = $human->getDad();
            
            if ( $mom != null){
                $childs.= self::html_child((string)$mom->getName());
                $childs.= $human->get_f_tree($mom);
            } 

            if ( $dad != null){
                $childs.= self::html_child((string)$dad->getName());
                $childs.= $human->get_f_tree($dad);
            }

            $parent .= self::html_parent($childs);
            return $parent;
        }

        public static function html_child($content){
            return "<li>".$content."</li>";
        }

        public static function html_parent($content){
            return "<ul>".$content."</ul>";
        }

    }

    $adam = new Human('Adam'); 
    $eve  = new Human('Eve', $adam); 
    $bob  = new Human('Bob', $adam, $eve);
    $cain = new Human('Cain', $bob, $eve); 
   
    echo $cain->get_f_tree();
