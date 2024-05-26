<?php 
    session_start();
    include "incs/db.php";
    require_once "assets/phpqrcode/qrlib.php";

    if(isset($_POST["cert"])){

        $course_id = $_POST['course_id'];
        $student_id = $_POST['student_id'];
        $type_degree = $_POST['type_degree'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $father_name = $_POST['father_name'];
        $address = $_POST['address'];
        $date = $_POST['date'];
        $certificate = "";





        $font = __DIR__ . "/assets/Regular.ttf";
        $second_font = __DIR__ . "/assets/DroidSerif-Bold.ttf";          
        $destinationPath = "uploads/";
        $destinationFile = "".time().".jpg"; 
        $image = imagecreatefromjpeg("assets/img/tem.jpg");
        $color = imagecolorallocate($image,19,21,22);
        $course = "SELECT * FROM courses WHERE id=?";
        $course_result = $con->prepare($course);
        $course_result->execute([$course_id]);
        $course_name = $course_result->fetch(PDO::FETCH_ASSOC);
        $course_name = $course_name['course_name'];
    
        imagettftext($image, 80, 0, 600, 705, $color, $font, $fname.' '.$lname);
        imagettftext($image, 50, 0, 920, 294, $color, $font, $course_name);
        imagettftext($image, 20, 0, 1350, 1140, $color, $font, $date);
        if ($type_degree=='DIPLOMA'){
            imagettftext($image, 90, 0, 715, 200, $color, $second_font, $type_degree);
        }else{
            imagettftext($image, 90, 0, 600, 200, $color, $second_font, $type_degree);
        }
        

        // $certificate=imagejpeg($image, "assets/img/certificate.jpg");
        $certificatePath = $destinationPath . $destinationFile;
        $certificate_save = imagejpeg($image, $certificatePath);
        $certificate= $destinationFile;


           
            

        $sql = "INSERT INTO certificate_details (course_id,student_id,type_degree,fname,lname,father_name,address,certificate,date)VALUES(?,?,?,?,?,?,?,?,?)";
        $result = $con->prepare($sql);
        $result -> execute([ $course_id, $student_id,$type_degree, $fname, $lname,$father_name, $address, $certificate,$date]);


        // $id = $con->lastInsertId();
        // $png_dir = "uploads/";
        // $qr_code_size = 10;
        // $margin = 6;
        // $file_name = $png_dir.'test.png';
        // $add_values ="http://localhost/final%20Smart%20academy/student_details.php".$id;
        // $timestamp = time();
        // $file_name = $png_dir . 'test' . $id . '_' . time() . '.png';
        // QRcode::png($add_values,$file_name);

        // $qr_code_image = imagecreatefrompng($file_name);

       
        // $qr_code_position_x = 600;  
        // $qr_code_position_y = 900;  

        // imagecopy($image, $qr_code_image, $qr_code_position_x, $qr_code_position_y, 0, 0, imagesx($qr_code_image), imagesy($qr_code_image));

        // $certificatePath = $destinationPath . $destinationFile;
        // $certificate_save = imagejpeg($image, $certificatePath);
        // $certificate =$destinationFile;


        $id = $con->lastInsertId();
        $png_dir = "uploads/";
        $qr_code_size = 10;
        $margin = 6;
        $file_name = $png_dir.'test.png';
        $add_values ="http://localhost/final%20Smart%20academy/student_details.php?id=".$id;
        $timestamp = time();
        $file_name = $png_dir . 'test' . $id . '_' . time() . '.png';
        QRcode::png($add_values,$file_name, $qr_code_size,$margin);

        $qr_code_image = imagecreatefrompng($file_name);

       
        $qr_code_position_x = 190;  
        $qr_code_position_y = 930;  

        imagecopy($image, $qr_code_image, $qr_code_position_x, $qr_code_position_y, 0, 0, imagesx($qr_code_image), imagesy($qr_code_image));

        $certificatePath = $destinationPath . $destinationFile;
        $certificate_save = imagejpeg($image, $certificatePath);
        $certificate =$destinationFile;

        


        $update = "UPDATE certificate_details SET certificate = ?, qr_code = ? WHERE id = ?";
        $update_result = $con->prepare($update);
        $update_result->execute([$certificate, $file_name, $id]);

        


        // echo '<img width="800" src="' . $destinationPath . $destinationFile . '" alt="Certificate">';
        // die();

       
        // $update = "UPDATE certificate_details SET certificate=?  qr_code =? WHERE id=?";
        // $update_result = $con -> prepare($update);
        // $update_result -> execute([$certificate,$qr_code_contents,$id]);

        if ($result){
            $_SESSION['generate_certificate_success'] = "Congratulations";
            header("location: graduate_students_list.php");
            die();
        }else{
            $_SESSION['generate_certificate_error'] = "Something Wont Wrong";
            header("location: apply_form_students_list.php");
            die();
        }

        imagedestroy($image);


        // 
        // 



    }


?>