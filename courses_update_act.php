<?php 
    session_start();
    include "incs/db.php";


    if (isset($_POST['update_course'])){
        
        $id = $_POST['id'];
        $course_name = $_POST['course_name'];
        $course_description = $_POST['course_description'];
        $fee = $_POST['fee'];
        $image_time = "";
        $status = $_POST['status'];

        if ($_FILES['image']['size'] > 0){

            $image = $_FILES['image']['name'];
            $allow = array('jpg', 'jpeg','png','gif','bmp','tif','tiff','ico');
            $path = pathinfo($image,PATHINFO_EXTENSION);
            $image_time = time().'.'.$path;

            if(!in_array($path,$allow)){
                $_SESSION['update_extension_error'] = "This file is not supported";
                header("location: courses_update.php?id=".urlencode(base64_encode($id)));
                die();
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$image_time)){

                $_SESSION['update_uploads_error'] = "Somethings Wont Wrong";
                header("location: courses_update.php?id=".urlencode(base64_encode($id)));
                die();
            }


        }

        $image_sql = "SELECT image FROM courses WHERE id=?";
        $image_sql_result = $con -> prepare($image_sql);
        $image_sql_result -> execute([$id]);
        $image_existing = $image_sql_result -> fetchColumn();

        if ($_FILES['image']['size']==0 && !empty($image_existing)){
            $image_time=$image_existing;
        }

       $sql = "UPDATE courses SET course_name =?, course_description =?, fee=?, image=?, status=? WHERE id=?";
       $result = $con -> prepare($sql);
       $result -> execute([$course_name,$course_description, $fee, $image_time,$status,$id]);

       if($result){

        $_SESSION['course_update_success'] = "Successfully Updated";
        header("Location: courses_list.php");
        die();

       }else{
        
        $_SESSION['course_update_error'] = "Something Went Wrong";
        header("Location: courses_update.php?id=".urlencode(base64_encode($id)));
        die();
       }


    }










?>