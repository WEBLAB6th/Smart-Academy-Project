<?php 
    session_start();
    include "incs/db.php";

    if (isset($_POST['create_course'])){

        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];
        $fee = $_POST['fee'];
        $image_time = '';
        $status = $_POST['status'];

        if ($_FILES['image']['size'] > 0){

            $image = $_FILES['image']['name'];
            $allow = array('jpg', 'jpeg','png','gif','bmp','tif','tiff','ico','jfif');
            $path = pathinfo($image,PATHINFO_EXTENSION);
            $image_time = time().'.'.$path;

            if(!in_array($path,$allow)){
                $_SESSION['extension_error'] = "This file is not supported";
                header("location:courses_create.php");
                die();
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$image_time)){

                $_SESSION['uploads_error'] = "Somethings Wont Wrong";
                header("location:courses_create.php");
                die();
            }

        }
        



        $sql = "INSERT INTO courses (course_name,course_description,fee,image,status) VALUES(?,?,?,?,?)";
        
        $result = $con -> prepare($sql);
        $result -> execute([$course_name,$course_description,$fee,$image_time,$status]);

        if ($result){
            $_SESSION['course_create_success'] = "Successfully Create New Course";
            header("Location:courses_list.php");
            die();
        }else{
            $_SESSION['course_create_error'] = "Somethings Wont Wrong";
            header("Location:courses_create.php");
            die();
        }
    }












?>