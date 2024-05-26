<?php 
    session_start();
    include "incs/db.php";

    $encodeId = $_GET['id'];
    $id = base64_decode($encodeId);


    $sql = "DELETE  FROM certificate_details WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['certificate_delete_success'] = "Successfully Deleted";
        header("Location: graduate_students_list.php");
        die();
    }else{
        
        $_SESSION['certificate_delete_error'] = "Something Went Wrong";
        header("Location: graduate_students_list.php");
        die();
    }







?>