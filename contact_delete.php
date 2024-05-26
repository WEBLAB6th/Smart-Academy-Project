<?php 
    session_start();
    include "incs/db.php";

    $encodeId = $_GET['id'];
    $id = base64_decode($encodeId);

    $sql = "DELETE  FROM contact WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['contact_delete_success'] = "Successfully Deleted";
        header("Location: contact_list.php");
        die();
    }else{

        $_SESSION['contact_delete_error'] = "Something Went Wrong";
        header("Location: contact_list.php");
        die();
    }







?>