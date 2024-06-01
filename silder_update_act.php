<?php 
    session_start();
    include "incs/db.php";


    if (isset($_POST['slider_update'])){
        
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $image_time = "";
      

        if ($_FILES['image']['size'] > 0){

            $image = $_FILES['image']['name'];
            $allow = array('jpg', 'jpeg','png','gif','bmp','tif','tiff','ico');
            $path = pathinfo($image,PATHINFO_EXTENSION);
            $image_time = time().'.'.$path;

            if(!in_array($path,$allow)){
                $_SESSION['slider_update_extension_error'] = "This file is not supported";
                header("location: silder_update.php?id=".urlencode(base64_encode($id)));
                die();
            }

            if (!move_uploaded_file($_FILES['image']['tmp_name'],'uploads/'.$image_time)){

                $_SESSION['slider_update_uploads_error'] = "Somethings Wont Wrong";
                header("location: silder_update.php?id=".urlencode(base64_encode($id)));
                die();
            }


        }

        $image_sql = "SELECT image FROM slider WHERE id=?";
        $image_sql_result = $con -> prepare($image_sql);
        $image_sql_result -> execute([$id]);
        $image_existing = $image_sql_result -> fetchColumn();

        if ($_FILES['image']['size']==0 && !empty($image_existing)){
            $image_time=$image_existing;
        }

       $sql = "UPDATE slider SET title =?, description =?, image=? WHERE id=?";
       $result = $con -> prepare($sql);
       $result -> execute([$title,$description, $image_time,$id]);

       if($result){

        $_SESSION['slider_update_success'] = "Successfully Updated";
        header("Location: silder_list.php");
        die();

       }else{
        
        $_SESSION['slider_update_error'] = "Something Went Wrong";
        header("Location: silder_update.php?id=".urlencode(base64_encode($id)));
        die();
       }


    }










?>