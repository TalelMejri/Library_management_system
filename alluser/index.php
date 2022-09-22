<?php 

    session_start();
    if(!isset($_SESSION['name'])){
        header("location:../login");
        exit;
    }
    $error=[];
    require_once("../classes/classes.php");
    $user=new user();
    $page=isset($_GET['page']) ? $_GET['page'] : 1 ;
    $limit=isset($_GET['record']) ? $_GET['record'] : 5 ;
    $next=$page < $user->countuser() /$limit ? $page+1 : 1 ;
    $previous= $page > 1 ? $page-1 : 1;
    $start=($page-1)* $limit;
    $pages=ceil($user->countuser()/$limit);
    if(isset($_POST['btn_search'])){
        extract($_POST);
        if(empty($search)){
            $error['search']="field empty";
        }
        $alluser=$user->getbyname($search);
        if($alluser){
            $alluser=$user->getbyname($search);
        }else{
            $alluser="vide";
        }
        $pages=ceil($user->countusersearch($search)/$limit);
        $next=$page < $user->countusersearch($search) /$limit ? $page+1 : 1 ;
        $previous= $page > 1 ? $page-1 : 1;
    }else{
        $alluser=$user->getalluser($limit,$start);
    }

    $show=null;
    $template="alluser";
    $page_titel="all user";
    include "../layout.phtml";
?>