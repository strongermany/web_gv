<?php
     // Use __DIR__ for a reliable relative path
    class DController {

        protected $load;
        public function __construct() {
           
            $this->load = new Load();
            
        }
    }
?>