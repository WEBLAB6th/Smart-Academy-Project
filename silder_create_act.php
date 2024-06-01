<?php 
    session_start();
    include "incs/db.php";

    if (isset($_POST['slider'])){

        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_time = '';
       
        if ($_FILES['image']['size'] > 0){

            $image = $_FILES['image']['name'];
            $allow = array('jpg', 'jpeg','png','gif','bmp','tif','tiff','ico');
            $path = pathinfo($image,PATHINFO_EXTENSION);
            $image_time = time().'.'.$path;

            if(!in_array($path,$allow)){

                $_SESSION['slider_extension_error'] = "This file is not supported";
                header("location:silder_create.php");
                die();
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$image_time)){

                $_SESSION['slider_uploads_error'] = "Somethings Wont Wrong";
                header("location:silder_create.php");
                die();
            }

        }
        



        $sql = "INSERT INTO slider (title,description,image) VALUES(?,?,?)";
        
        $result = $con -> prepare($sql);
        $result -> execute([$title,$description,$image_time]);

        if ($result){
            $_SESSION['slider_create_success'] = "Successfully Create New Course";
            header("Location:silder_list.php");
            die();
        }else{
            $_SESSION['slider_create_error'] = "Somethings Wont Wrong";
            header("Location: silder_create.php");
            die();
        }
    }












?>