<?php 
    session_start();
    include "incs/db.php";

    $encode = $_GET['id'];

    $id = base64_decode($encode);

    $sql = "DELETE FROM courses WHERE id=?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    if ($result){

        $_SESSION['course_delete_success'] ="Deleted SuccessFully";
        header("Location: courses_list.php");
        die();
    }else{
        $_SESSION['course_delete_error'] ="Something Went Wrong";
        header("Location: courses_list.php");
        die();
    }






?>