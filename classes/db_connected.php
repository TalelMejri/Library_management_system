<?php

     class database extends PDO{
        const DB_HOST="localhost";
        const DB_NAME="library_management";
        const DB_PASS="";
        const DB_USER="root";

         public function __construct(){
            $dsn='mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME;
            try{
                parent::__construct($dsn,self::DB_USER,self::DB_PASS);
                $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                $this->query('SET NAMES UTF8');
                echo "jawek behyy";
            }catch(Exception $e){
                echo 'connect failed :'.$e->getMessage();
            }
        }
    }

?>