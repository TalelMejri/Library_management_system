<?php

    include_once "db_connected.php";
    class comment{
        private $pdo;
         public function __construct(){
            $this->pdo=new database();
         }

         public function addmessage(String $name,String $email,String $message):int{
            
            $sql="INSERT INTO `commentaire` (`nom`, `email`, `messages`) VALUES (:nom,:email,:messages)";
            $this->pdo->launch_query($sql,
               ['nom'=>$name,
                'email'=>$email,
                'messages'=>$message
                ]);
                $lastid=$this->pdo->lastInsertId();
                return $lastid;
        }

        public function getlastmessage(){
         $sql="SELECT * FROM commentaire order by id DESC Limit 1";
         $query= $this->pdo->launch_query($sql);
         return $query->fetchAll();
        }

        public function allmessages(){
         $sql="SELECT * FROM commentaire";
         $query= $this->pdo->launch_query($sql);
         return $query->fetchAll();
        }

    }


 ?>