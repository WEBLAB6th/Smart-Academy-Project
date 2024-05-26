<?php 
    session_start();

    include "incs/db.php";

    if (isset($_POST['update_gallery'])){

        $id = $_POST['id'];
        $student_name = $_POST['student_name'];
        $job = $_POST['job'];
        $description = $_POST['description'];
        $images_time = [];
      

        

        foreach($_FILES['images']['tmp_name'] AS $key => $tmp_image){
            
            $image = $_FILES['images']['name'][$key];
            
            if ($_FILES['images']['size'][0]  > 0){

                $allow_image_extension = Array ('jpg','jpeg','png','gif','bmp','tif','tiff','ico','jfif');
                $image_path = pathinfo($image,PATHINFO_EXTENSION);
                $images_time = time()."_".$key.".".$image_path;

                

                if(!in_array($image_path,$allow_image_extension)){

                    $_SESSION['gallery_update_extensions_error'] = "This file is not supported";
                    header("location:gallery_update.php?id=".urlencode(base64_encode($id)));
                    die();
                   

                }
                if(!move_uploaded_file($tmp_image,'uploads/'.$images_time)){

                    $_SESSION['gallery_update_path_error'] = "Somethings Wont Wrong";
                    header("location:gallery_update.php?id=".urlencode(base64_encode($id)));
                    die();
                   

                }

            }

            $images_into_convert_array []=$images_time;
        }

      

      

        $images_array_into_convert_str = implode(",",$images_into_convert_array);

       

        $existing_images = "SELECT images FROM gallery WHERE id =?";
        $existing_images_result = $con -> prepare($existing_images);
        $existing_images_result -> execute([$id]);
        $existing_images_fetch = $existing_images_result -> fetchColumn();
            

           
        if ($_FILES['images']['size'][0] == 0 && !empty($existing_images_fetch)){
           
            $images_array_into_convert_str =  $existing_images_fetch;
           
        }
        
   

        $sql = "UPDATE gallery SET  student_name=?, job=?, description=?, images=? WHERE id=?";
        $result =  $con -> prepare($sql);
        $result -> execute([$student_name, $job,$description,$images_array_into_convert_str,$id]);

        if ($result){

            $_SESSION['gallery_update_success'] ="Successfully Update Gallery";
            header("Location: gallery_list.php");
            die();
        }else{
            $_SESSION['gallery_update_error'] ="Something Wont Wrong";
            header("Location: gallery_update.php?id=".urlencode(base64_encode($id)));
            die();
        }


    }








?>