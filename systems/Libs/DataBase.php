<?php
    class DataBase extends PDO {
        public function __construct($connect,$user,$pass){
               parent::__construct($connect,$user,$pass);
        }
    
        // Do not know how many arguments
        public function select($sql, $data = array(), $fetchStyle = PDO::FETCH_ASSOC){
            $statement = $this->prepare($sql);
            
            if(!empty($data)){
                foreach($data as $key => $value){
                    // Check if the key is a string (named parameter)
                    if(is_string($key)){
                        $statement->bindValue($key, $value);
                    } else {
                        // For numeric keys (positional parameters)
                        $statement->bindValue($key + 1, $value);
                    }
                }
            }
            
            $statement->execute();
            return $statement->fetchAll($fetchStyle); 
        }
        public function insert($table ,$data){
            $keys = implode(",",array_keys($data));
            $values = ":".implode(", :",array_keys($data));
            $sql = "Insert into $table($keys) values($values)";
            $statement = $this->prepare($sql);
            foreach($data as $key => $value){
                $statement->bindValue(":$key",$value);
            }
            return $statement->execute();
            
        }

        public function update($table,$data,$cond){
            $updateKeys=NULL;
            foreach($data as $key => $value){
                $updateKeys .="$key=:$key,";
            }
            $updateKeys = rtrim($updateKeys,",");

            $sql="Update $table set $updateKeys Where $cond";
            $statement = $this->prepare($sql);
            
            // Bind values for SET clause
            foreach($data as $key => $value){
                $statement->bindValue(":$key",$value);
            }
            
            // Bind values for WHERE clause if they exist in $data
            if (preg_match_all('/:(\w+)/', $cond, $matches)) {
                foreach ($matches[1] as $param) {
                    if (isset($data[$param])) {
                        $statement->bindValue(":$param", $data[$param]);
                    }
                }
            }
            
            return $statement->execute();
        }
        public function delete($table,$cond,$limit = 1){
            $sql = "Delete from $table Where $cond Limit $limit";
            $statement = $this->prepare($sql);
            return $statement->execute();

        }
        public function affectedRows($sql,$username,$password){// check fit with data basse or not;
            $statement = $this->prepare($sql);
            $statement->execute(array($username,$password));
            return $statement->rowCount(); 
        }

        public function selectUser($sql,$username,$password){

            $statement = $this->prepare($sql);
            $statement->execute(array($username,$password));
            return $statement->fetchAll(PDO::FETCH_ASSOC); 
 
        }   

    
    }
    

?>