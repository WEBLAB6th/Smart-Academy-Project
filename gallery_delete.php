<?php 
    session_start();
    include "incs/db.php";

    $encode = $_GET['id'];

    $id = base64_decode($encode);

    $sql = "DELETE FROM gallery WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['gallery_delete_success'] ="Deleted SuccessFully";
        header("Location: gallery_list.php");
        die();
    }else{
        $_SESSION['gallery_delete_error'] ="Something Went Wrong";
        header("Location: gallery_list.php");
        die();
    }






?>