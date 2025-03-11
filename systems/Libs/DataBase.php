<?php
    class Database extends PDO {
        public function __construct($connect,$user,$pass){
               parent::__construct($connect,$user,$pass);
        }
    
        // Do not know how many arguments
        public function select($sql,$data = array(),$fetchStyle = PDO::FETCH_ASSOC){
                
            $statement = $this->prepare($sql);
            foreach($data as $key => $value){
                $statement->bindValue($key,$value);
            }

            
            $statement->execute();
            return $statement->fetchAll(); 
            
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
            foreach($data as $key => $value){
                $statement->bindValue(":$key",$value);
            }
            return $statement->execute();

        }
        public function delete($table,$cond,$limit = 1){
            $sql = "Delete from $table Where $cond Limit $limit";
            $statement = $this->prepare($sql);
            return $statement->execute();

        }

    
    }
    

?>