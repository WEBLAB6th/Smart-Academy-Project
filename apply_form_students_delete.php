<?php 
    session_start();
    include "incs/db.php";

    $encodeId = $_GET['id'];
    $id = base64_decode($encodeId);

    $sql = "DELETE  FROM apply_form_students WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['student_delete_success'] = "Successfully Deleted";
        header("Location: apply_form_students_list.php");
        die();
    }else{

        $_SESSION['student_delete_error'] = "Something Went Wrong";
        header("Location: apply_form_students_list.php");
        die();
    }







?>