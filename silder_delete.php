<?php 
    session_start();
    include "incs/db.php";

    $encode = $_GET['id'];

    $id = base64_decode($encode);

    $sql = "DELETE FROM slider WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['slider_delete_success'] ="Deleted SuccessFully";
        header("Location: silder_list.php");
        die();
    }else{
        $_SESSION['slider_delete_error'] ="Something Went Wrong";
        header("Location: silder_list.php");
        die();
    }






?>