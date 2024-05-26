<?php 
    session_start();
    include "incs/db.php";
   

    if (isset($_POST['apply'])){
        $course_id = $_POST['course_id'];
        $fname =  $_POST['fname'];
        $lname =  $_POST['lname'];
        $father_name = $_POST['father_name'];
        $email =  $_POST['email'];
        $pnumber =  $_POST['pnumber'];
        $address = $_POST ['address'];
        $qualification =  $_POST['qualification'];
        $fee =  $_POST['fee'];




        // $png_dir = "uploads/";
        // $file_name = 'test.png';  // Assuming you want to keep the original file name

        // $add_values = $_POST['fname'];
        // $timestamp = time();
        // $file_name_with_timestamp = 'test' . $add_values . '_' . $timestamp . '.png';
        // $full_path = $png_dir . $file_name_with_timestamp;
        // QRcode::png($add_values, $full_path);

        $sql = "INSERT INTO apply_form_students (course_id,fname,lname,father_name,email,pnumber,address,qualification,fee) VALUES (?,?,?,?,?,?,?,?,?)";
        $result = $con -> prepare($sql);
        $result -> execute([$course_id,$fname,$lname,$father_name,$email,$pnumber,$address,$qualification,$fee]);

      

        if ($result){
            $_SESSION['student_apply_success'] = "Apply Successfully Submitted";
            header("Location: apply_form_students_list.php");
            die();
        }else{
            $_SESSION['student_apply_error'] = "Something Wont Wrong";
            header("Location: apply_form_students_create.php");
            die();
        }
    }

    




?>