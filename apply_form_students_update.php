<?php include "incs/auth.php";
 ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<?php
    $decodeId = $_GET['id'];
    $id = base64_decode($decodeId);

    $sql = "SELECT * FROM apply_form_students WHERE id =?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);

    $row = $result -> fetch(PDO::FETCH_ASSOC);
    $fee = $row['fee'];


?>

<?php
    $courses_sql = "SELECT * FROM courses WHERE status =1";
    $courses_sql_result = $con -> prepare($courses_sql);
    $courses_sql_result -> execute();
    $get = $courses_sql_result -> fetch(PDO::FETCH_ASSOC);
    $total_fee = $get['fee'];
    ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Record Update Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Student Record Update Page</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Record Update Page</h3>
             
                    <?php if ($total_fee > $fee){ ?>
                        
                        <h5 id="autoHideMessage" class="bg-danger p-1 text-center mt-4"> <i class="blink"> First Clear Your Payment </i></h5>
                    <?php  } ?>
               
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <?php 
                if (isset($_SESSION['update_student_data_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['update_student_data_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['update_student_data_error']);  }
            
            ?>

            
            <div class="card-body">
                <form action="apply_form_students_update_act.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class="row mb-3 mt-3">
                        <div class="col-md-3">
                            <label for="course" class=" form-label">Course</label>
                        </div>
                        <div class="col-md-9">
                            <select name="course_id" class=" form-control">
                                <option value="<?php if ($row['course_id']==$get['id']) echo "SELECTED" ?>">
                                    <?php echo $get['course_name'] ?></option>
                                <?php ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="fname" class=" form-label">First Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fname" id="fname" placeholder="Enter your First Name"
                                class=" form-control" value="<?php echo $row['fname'] ?>">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="lname" class=" form-label">Last Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="lname" id="lname" placeholder="Enter your Last Name"
                                class=" form-control" value="<?php echo $row['lname'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="father_name" class=" form-label">Father Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="father_name" id="father_name" class=" form-control" value="<?php echo $row['father_name'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="email" class=" form-label">Email</label>
                        </div>
                        <div class="col-md-9">
                            <input type="email" name="email" id="email" placeholder="Example@gmail.com"
                                class=" form-control" value="<?php echo $row['email'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="pnumber" class=" form-label">Phone Number</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="pnumber" id="pnumber" class=" form-control"
                                value="<?php echo $row['pnumber'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="address" class=" form-label">Address</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="address" id="address" placeholder="Enter Your address"
                                class=" form-control" value="<?php echo $row['address'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="qualification" class=" form-label">Qualification</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="qualification" id="qualification" class=" form-control"
                                placeholder="Enter Your Qualification" value="<?php echo $row['qualification'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="fee" class=" form-label">Fee</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fee" id="fee" class=" form-control"
                                value="<?php echo $row['fee'] ?>RS/<?php echo $total_fee ?>RS">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="status" class=" form-label">Status</label>
                        </div>
                        <div class="col-md-9">
                            <?php
                               $panding_fee = $total_fee - $fee;
                             if ($panding_fee > 0) { ?>
                            <select name="status" id="status" class="form-control"  disabled>
                                <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>
                                    Pending</option>
                                <option value="Progress"
                                    <?php echo ($row['status'] == 'Progress') ? 'selected' : ''; ?>>Progress</option>
                                <option value="Completed"
                                    <?php echo ($row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            </select>
                            <?php  } else{ ?>

                                <select name="status" id="status" class="form-control">

                                <option value="Pending" <?php echo ($row['status'] == 'Pending') ? 'selected' : ''; ?>>
                                    Pending</option>
                                <option value="Progress"
                                    <?php echo ($row['status'] == 'Progress') ? 'selected' : ''; ?>>Progress</option>
                                <option value="Completed"
                                    <?php echo ($row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            </select>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" value="Update" name="update_student_data" class="btn btn-outline-success float-right pr-5 pl-5">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>