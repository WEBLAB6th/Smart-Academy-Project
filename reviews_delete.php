<?php 
    session_start();
    include "incs/db.php";

    $encodeId = $_GET['id'];
    $id = base64_decode($encodeId);

    $sql = "DELETE  FROM reviews WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['reviews_delete_success'] = "Successfully Deleted";
        header("Location: reviews_list.php");
        die();
    }else{

        $_SESSION['reviews_delete_error'] = "Something Went Wrong";
        header("Location: reviews_list.php");
        die();
    }







?>