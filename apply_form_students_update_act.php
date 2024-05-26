<?php 
    session_start();
    include "incs/db.php";

    if (isset($_POST['update_student_data'])){

        $id = $_POST['id'];
       
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $father_name = $_POST['father_name'];
        $email = $_POST['email'];
        $pnumber = $_POST['pnumber'];
        $address = $_POST['address'];
        $qualification = $_POST['qualification'];
        $fee = $_POST['fee'];
        $status = $_POST['status'];

        $sql = "UPDATE apply_form_students SET fname = ?,lname=?,father_name=?,email=?,pnumber=?,address=?,qualification=?,fee=?,status=? WHERE id=?";
        $result = $con -> prepare($sql);
        $result -> execute([ $fname,$lname,$father_name,$email, $pnumber,$address, $qualification, $fee,$status,$id]);

        if ($result){
            $_SESSION['update_student_data_success'] = "Successfully Updated";
            header("Location:apply_form_students_list.php");
            die();
        }else{
            $_SESSION['update_student_data_error'] = "Something Wont Wrong";
            header("Location:apply_form_students_update.php?id=".urlencode(base64_encode($id)));
            die();
        }


    }



?>