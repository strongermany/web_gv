<?php
    class ProductController extends DController {
        public function __construct() {
            parent::__construct();
        }
        public function index() {
            return $this->listClass();
        }
        public function listClass() {
            echo "this is product controller add method ";
        }
    }

?>