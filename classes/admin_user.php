
 <?php 
    include "db_connected.php";

    class user {
        private $pdo;
        public function __construct(){
            $this->pdo=new database();
        }

        public function login_admin(String $email,String $pass):bool{
            $sql="SELECT * FROM admin where email=:email AND password=:pass AND role=:role";
            $query=$this->pdo->launch_query($sql,['email'=>$email,'pass'=>$pass,'role'=>1]);
            $user=$query->fetch();
            if($user==false){
                return false;
            }else{
                $_SESSION['id']=$user['id'];
                $_SESSION['name']=$user['name'];
                $_SESSION['email']=$user['email'];
                $_SESSION['password']=$user['password'];
                $_SESSION['role']=$user['role'];
                $_SESSION['avatar_admin']=$user['avatar_admin'];
                return true;
            }
        }

        public function  edit_admin(String $name,String $email,String $password,String $avatar){
            $sql="UPDATE `admin` SET id=:id_admin,name=:name_admin,email=:email_admin,password=:pass,avatar_admin=:avatar";
            $this->pdo->launch_query($sql,[
                'id_admin'=>$id,
                'name_admin'=>$name,
                'email_admin'=>$email,
                'pass'=>$password,
                'avatar'=>$avatar]);
        }

        public function signup(String $name,String $email,int $cin,int $tlf,String $password,String $avatar){
            $sql="INSERT INTO `admin`( `name`, `email`, `password`, `avatar_admin`, `tlf`, `cin`, `role`, `corbeille`)  VALUES (:name,:email,:pass,:avatar,:tlf,:cin,:role,:corbeille)";
            $this->pdo->launch_query($sql,[
                'name'=>$name,
                'email'=>$email,
                'pass'=>password_hash($password,PASSWORD_DEFAULT),
                'avatar'=>$avatar,
                'role'=>0,
                'cin'=>$cin,
                'tlf'=>$tlf,
                'corbeille'=>0,
            ]);
            return $this->pdo->lastInsertId();
        }

        public function allcin(){
            $sql="SELECT cin from admin";
            $query=$this->pdo->launch_query($sql);
            return $query->fetchAll();
        }

        public function getalluser(){
            $sql="SELECT * from admin where role=:rolee AND corbeille=:corb";
            $query=$this->pdo->launch_query($sql,['rolee'=>0,'corb'=>0]);
            return $query->fetchAll();
        }

        public function deleteuser(int $id){
            $sql="UPDATE admin SET corbeille=:corb where id=:iduser";
            $this->pdo->launch_query($sql,['corb'=>1,'iduser'=>$id]);
        }

        public function getuserbyid(int $id){
            $sql="SELECT * from admin where id=:iduser";
            $query=$this->pdo->launch_query($sql,['iduser'=>$id]);
            return $query->fetch();
        }

        
    }


?>