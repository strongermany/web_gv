<?php
    class Main{
        /** @var array */
        public $url = ["index"];
        public $controllerName = "index";
        public $methodName = "index";
        public $controllerPath = "apps/Controllers/";
        public $controller;

        public function __construct(){
            $this->getUrl();
            $this->loadController();
            $this->callMethod();
        }

        public function getUrl(){
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $parts = explode('/', filter_var($url, FILTER_SANITIZE_URL));
                if (!empty($parts)) {
                    $this->url = $parts;
                }
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
                return;
            }

            // Nếu có method name trong URL
            if(isset($this->url[1])){
                $this->methodName = $this->url[1];
                
                if(method_exists($this->controller, $this->methodName)){
                    // Lấy tất cả các tham số từ URL (bỏ qua controller và method)
                    $params = array_slice($this->url, 2);
                    
                    if(count($params) > 0){
                        // Gọi method với các tham số
                        call_user_func_array(array($this->controller, $this->methodName), $params);
                    } else {
                        // Gọi method không có tham số
                        $this->controller->{$this->methodName}();
                    }
                } else {
                    header("Location:".Base_URL."index/notFound");
                }
            } else {
                // Không có method name, gọi index
                if(method_exists($this->controller, "index")){
                    $this->controller->index();
                } else {
                    header("Location:".Base_URL."index/notFound");
                }
            }
        }
    }
?>


