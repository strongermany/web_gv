<?php
    class Main{


        public  $url;
        public $controllerName = "index";
        public $methodName="index";
        public $controllerPath ="apps/Controllers/";
        public $controller;

        public function __construct(){
            $this->getUrl();
            $this->loadController();
            $this->callMethod();
            
        }

        // public function getUrl(){
            // $this->url = isset($_GET['url']) ? $_GET['url'] : NULL;
            // 
            // if($this->url != NULL){
                // $this->url = rtrim($this->url,'/');// split url to string
                // $this->url = explode('/',filter_var($this->url, FILTER_SANITIZE_URL));
                // var_dump($this->url);
            // 
            // }
            // else {
                // 
            // 

                // $this->url =NULL; // Gán thành mảng rỗng thay vì `unset`
            // }
        // }
        public function getUrl(){
            $this->url = isset($_GET['url']) ? $_GET['url'] : NULL;
        
            if ($this->url !== NULL) {
                $this->url = rtrim($this->url, '/'); // Xóa dấu `/` cuối cùng
                $this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL)); 
            } 
              
            
        }
        
        public function loadController(){
            
            if(!isset($this->url[0])){
               
                require_once $this->controllerPath.$this->controllerName.'.php';
                $this->controller = new $this->controllerName();

            }else{
                
                $this->controllerName = $this->url[0];
                $fileName=$this->controllerPath.$this->controllerName.'.php';
                if(file_exists($fileName)){
                    
                    include $fileName;// check class;
                    if(class_exists($this->controllerName)){
                        $this->controller = new $this->controllerName();
                        
                    }
                }
            }
        }
        public function callMethod(){
            if (!is_object($this->controller)) {
                header("Location:".Base_URL."index/notFound");
            }
            if(isset($this->url[2])){
                
                $this->methodName=$this->url[1];
                if(method_exists($this->controller,$this->methodName)){
                    $this->controller->{$this->methodName}($this->url[2]);
                }else{
                    header("Location:".Base_URL."index/notFound");

                }
            }else{
                
                if(isset($this->url[1])){
                    
                    $this->methodName=$this->url[1];
                    if(method_exists($this->controller,$this->methodName)){
                        $this->controller->{$this->methodName}();
                    }
                    else{
                        header("Location:".Base_URL."index/notFound");
                    }
                }
                // else{ 
                    // echo "1";                  
                        // if(method_exists($this->controller,$this->methodName)){// call method exist argument have to differ NULL value;
                            // $this->controller->{$this->methodName}();
                        // }
                        // else{
                            // header("Location:".Base_URL."index/notFound");
                        // }
                    // 
                // }
            }
        }
    }
?>


