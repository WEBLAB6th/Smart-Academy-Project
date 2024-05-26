<?php 
    session_start();
    include "incs/db.php";

    if (isset($_POST['create_gallery'])){

        $course_id = $_POST['course_id'];
        $student_name = $_POST['student_name'];
        $job = $_POST['job'];
        $description = $_POST['description'];
        $images_time = [];
       

        

        foreach($_FILES['images']['tmp_name'] AS $key => $tmp_images){

            $images = $_FILES['images']['name'][$key];

            if ($_FILES['images']['size'] > 0){
                
                $allow_extensions = array('jpg', 'jpeg','png','gif','bmp','tif','tiff','ico','jfif');
                $path = pathinfo($images,PATHINFO_EXTENSION);
                $images_time = time()."_".$key.".".$path;

                if (!in_array($path,$allow_extensions)){

                    $_SESSION['gallery_extension_error'] = "This file is not supported";
                    header("location:gallery_create.php");
                    die();

                }

                if (!move_uploaded_file($tmp_images,'uploads/'.$images_time)){

                    $_SESSION['gallery_uploads_error'] = "Somethings Wont Wrong";
                    header("location: gallery_create.php");
                    die();

                }

            }

            $convert_array[]=$images_time; 
        }
        

      

        $convert_images_into_str = implode(',',$convert_array);

       
        $sql = "INSERT INTO gallery (course_id, student_name, job, description, images) 
        VALUES(?, ?, ?, ?, ?)";
        
        $result = $con -> prepare($sql);
        $result -> execute([$course_id, $student_name, $job, $description, $convert_images_into_str]);

        if($result){
           
            $_SESSION['gallery_success'] ="Successfully Add Gallery";
            header("Location: gallery_list.php");
            die();
        }else{
            $_SESSION['gallery_error'] ="Something Wont Wrong";
            header("Location: gallery_create.php");
            die();
        }
        
    }
















?>