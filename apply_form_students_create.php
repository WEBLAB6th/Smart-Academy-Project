<?php include "incs/auth.php";
 ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Student Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Student Registration</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Student Registration</h3>
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
                if (isset($_SESSION['student_apply_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['student_apply_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['student_apply_error']);  }
            
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <form action="apply_form_students_create_act.php" method="POST" enctype="multipart/form-data" id="apply_form">
                                <div class="row mb-3 mt-3">
                                    <div class="col-md-3">
                                        <label for="course" class=" form-label">Course</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="course_id" class=" form-control">
                                            <?php 
                                            $courses_sql = "SELECT * FROM courses WHERE status =1";
                                            $courses_sql_result = $con -> prepare($courses_sql);
                                            $courses_sql_result -> execute();
                                            foreach($courses_sql_result as $course_names) { ?>
                                                 <option value="<?php echo $course_names['id']  ?>"><?php echo $course_names['course_name']  ?></option>
                                           <?php }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="fname" class=" form-label">First Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="fname" id="fname" placeholder="Enter your First Name"
                                            class=" form-control">
                                    </div>

                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="lname" class=" form-label">Last Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="lname" id="lname" placeholder="Enter your Last Name"
                                            class=" form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="father_name" class=" form-label">Father Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="father_name" id="father_name" placeholder="Enter your Father Name"
                                            class=" form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="email" class=" form-label">Email</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" name="email" id="email" placeholder="Example@gmail.com"
                                            class=" form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="pnumber" class=" form-label">Phone Number</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="pnumber" id="pnumber" placeholder="Enter Phone Number"
                                            class=" form-control">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="address" class=" form-label">Address</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="address" id="address" placeholder="Enter Your address"
                                            class=" form-control">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="qualification" class=" form-label">Qualification</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="qualification" id="qualification" class=" form-control"
                                            placeholder="Enter Your Qualification">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="fee" class=" form-label">Fee</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="fee" id="fee" class=" form-control" placeholder="Amount">
                                    </div>
                                </div>
                                <div class=" float-right mt-3">
                                    <input type="submit" value="Registration" name="apply" class="btn btn-success btn-sm">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>