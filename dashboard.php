<?php
    include "incs/auth.php";
    include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>


<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Dashboard</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-info">
                                    <?php  
                                        $total_courses = "SELECT count(*) AS total_course FROM courses";
                                        $total_courses_result = $con-> prepare($total_courses);
                                        $total_courses_result -> execute();
                                        $total_courses = $total_courses_result -> fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <div class="inner">
                                        <p>Courses</p>
                                        <h3><?php echo $total_courses['total_course'] ?></h3>


                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <a href="courses_list.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-danger">
                                    <?php  
                                        $course_deactivate = "SELECT count(*) AS total_rows FROM courses WHERE status = '0'";
                                        $deactivate_result = $con -> prepare($course_deactivate);
                                        $deactivate_result -> execute();
                                        $deactivate = $deactivate_result -> fetch(PDO::FETCH_ASSOC);
                                        $num_deactivated_courses = $deactivate['total_rows'];
                                        
                                    ?>
                                    <div class="inner">
                                        <p>Deactivated Courses</p>
                                        <h3><?php echo $num_deactivated_courses ?></h3>


                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                    <a href="deactivated_courses.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-gradient-gray-dark">
                                    <div class="inner">
                                        <?php
                                            $total_teachers = "SELECT count(*) AS total_teachers FROM teachers";
                                            $total_teachers_result = $con -> prepare($total_teachers);
                                            $total_teachers_result-> execute();
                                            $teacher = $total_teachers_result -> fetch(PDO::FETCH_ASSOC);
                                            $total_teachers_result_total = $teacher['total_teachers'];
                                        
                                        
                                        ?>
                                        <p>Teachers</p>
                                        <h3><?php echo $total_teachers_result_total ?></h3>


                                    </div>
                                    <div class="icon">

                                        <i class="fas fa-chalkboard-teacher"></i>
                                    </div>
                                    <a href="teacher_list.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <?php
                                        $total_students = "SELECT count(*) AS total_students FROM apply_form_students";
                                        $total_students_result = $con -> prepare($total_students);
                                        $total_students_result-> execute();
                                        $students = $total_students_result -> fetch(PDO::FETCH_ASSOC);
                                        $total_students_result_total = $students['total_students'];
                                        
                                        
                                        ?>

                                        <p>Total Registered Students</p>
                                        <h3><?php echo $total_students_result_total ?></h3>


                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <a href="apply_form_students_list.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-blue">
                                    <div class="inner">
                                        <?php
                                        $total_student_progress = "SELECT count(*) AS total_student_progress FROM apply_form_students WHERE status ='Progress'";
                                        $total_students_progress_result = $con -> prepare($total_student_progress );
                                        $total_students_progress_result -> execute();
                                        $student_progress = $total_students_progress_result -> fetch(PDO::FETCH_ASSOC);
                                        $total_student_progress_result_total = $student_progress['total_student_progress'];
                                        
                                        
                                        ?>
                                        <p>Total Progress Students</p>
                                        <h3><?php echo $total_student_progress_result_total ?></h3>


                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <a href="total_progress_students.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-fuchsia">
                                    <div class="inner">
                                        <?php
                                        $total_student_Complete = "SELECT count(*) AS total_student_Complete FROM apply_form_students WHERE status ='Completed'";
                                        $total_students_Complete_result = $con -> prepare($total_student_Complete );
                                        $total_students_Complete_result -> execute();
                                        $student_Complete = $total_students_Complete_result -> fetch(PDO::FETCH_ASSOC);
                                        $total_student_Complete_result_total = $student_Complete['total_student_Complete'];
                                        
                                        
                                        ?>
                                        <p>Total Graduate Students</p>
                                        <h3><?php echo $total_student_Complete_result_total ?></h3>


                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <a href="total_graduate_student.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-gradient-pink">
                                    <div class="inner">
                                        <?php
                                        $total_fee = "SELECT count(*) AS total_fee,sum(fee) AS total_pkr FROM apply_form_students";
                                        $total_fee_result = $con -> prepare($total_fee );
                                        $total_fee_result -> execute();
                                        $fee = $total_fee_result -> fetch(PDO::FETCH_ASSOC);
                                        $total_fee_result_total = $fee['total_pkr'];
                                        
                                        
                                        ?>
                                        <p>Over payments</p>
                                        <h3><?php echo $total_fee_result_total ?>PKR</h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-gradient-lime">
                                    <div class="inner">
                                        <?php
                                        $total_student_Pending = "SELECT count(*) AS total_student_padding FROM apply_form_students WHERE status ='Pending'";
                                        $total_students_Pending_result = $con -> prepare($total_student_Pending);
                                        $total_students_Pending_result -> execute();
                                        $student_Pending = $total_students_Pending_result -> fetch(PDO::FETCH_ASSOC);
                                        $total_student_Pending_result_total = $student_Pending['total_student_padding'];
                                        
                                        
                                        ?>
                                        <p>panding payment Students</p>
                                        <h3><?php echo $total_student_Pending_result_total ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <a href="padding_payment_students.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-4 col-6">
                                <!-- small card -->
                                <div class="small-box bg-gradient-indigo">
                                    <div class="inner">
                                        <?php 
                                            $get_certificate = "SELECT count(*) AS total_certified_students FROM certificate_details";
                                            $get_certificate_result = $con -> prepare($get_certificate);
                                            $get_certificate_result->execute();
                                            $certified_students = $get_certificate_result->fetch(PDO::FETCH_ASSOC);
                                            $certified = $certified_students['total_certified_students']
                                        ?>
                                        <p>Certified Students</p>
                                        <h3><?php echo $certified ?></h3>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                    <a href="graduate_students_list.php" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            
                            <div class="col-md-12 mb-4 ">
                                <h2 class=" d-inline p-2 border border-3  border-danger border-top-0 border-right-0 border-left-0"> <i> Courses </i></h2>
                            </div>
                               
                            <?php
                                $index = 0;
                                $course_details = "SELECT * FROM courses ORDER BY RAND() LIMIT 10";
                                $courses_details_result = $con-> prepare($course_details);
                                $courses_details_result -> execute();
                                $course_fetch = $courses_details_result -> fetchAll(PDO::FETCH_ASSOC);
                                foreach($course_fetch AS  $row){ 

                                    $course_id = $row['id'];
                                   
                                     // Count the total students
                                     $total_students_query = "SELECT COUNT(*) as total_course_students FROM  apply_form_students WHERE  course_id= ?";
                                     $total_course_students_result = $con->prepare($total_students_query);
                                     $total_course_students_result->execute([$course_id]);
                                     
                                     // Check if any rows were affected by the query
                                     if ($total_course_students_result->rowCount() > 0) {
                                         $total_course_students = $total_course_students_result->fetch(PDO::FETCH_ASSOC);
                                         $get_total_student = $total_course_students['total_course_students'];
                                     } else {
                                         $get_total_student = 0; // No students found
                                     }
                                     
                                     // Count the progress students
                                     $progress_students_query = "SELECT COUNT(*) as progress_students FROM apply_form_students WHERE course_id = ? AND status = 'Progress'";
                                     $progress_students_result = $con->prepare($progress_students_query);
                                     $progress_students_result->execute([$course_id]);
                                     
                                     if ($progress_students_result->rowCount() > 0) {
                                        $progress_students = $progress_students_result->fetch(PDO::FETCH_ASSOC);
                                        $get_progress_student = $progress_students['progress_students'];
                                     } else {
                                         $get_progress_student = 0; // No progress students found
                                     }

                                     $complete_students_query = "SELECT COUNT(*) as completed_students FROM apply_form_students WHERE course_id = ? AND status = 'Completed'";
                                     $complete_students_result = $con->prepare($complete_students_query);
                                     $complete_students_result->execute([$course_id]);
                                     
                                     if ($complete_students_result->rowCount() > 0) {
                                        $complete_students = $complete_students_result->fetch(PDO::FETCH_ASSOC);
                                        $get_complete_student = $complete_students['completed_students'];
                                     } else {
                                         $get_complete_student = 0; // No progress students found
                                     }
                                     
                                    
                                     $bg_color_class = ($index % 2 == 0) ? 'bg-success' : 'bg-danger';  
                                ?>


                              
                            <div class="col-lg-6 col-6">
                                <!-- small card -->
                                <div class="small-box <?php echo $bg_color_class ?>">
                                    <div class="inner">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <p><?php echo $row['course_name'] ?> Total Students</p>
                                                <h3><?php echo $get_total_student ?></h3>
                                            </div>
                                            <div class="col-md-4">
                                                <p><?php echo $row['course_name'] ?>Progress Students</p>
                                                <h3><?php echo $get_progress_student  ?></h3>
                                            </div>
                                            <div class="col-md-4">
                                                <p><?php echo $row['course_name'] ?> Graduate Students</p>
                                                <h3><?php echo $get_complete_student ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-stats-bars"></i>
                                    </div>
                                    
                                </div>
                            </div>

                            <?php   $index++; } ?>
                          
                            <div class="m-auto mb-5">
                                <a href="all_courses_details.php" class="btn btn-danger btn-sm">All Courses</a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>
                                    <?php 
                                        $contact = "SELECT count(*) AS all_contacts FROM contact";
                                        $contact_result = $con -> prepare($contact);
                                        $contact_result -> execute();
                                        $total_contact = $contact_result -> fetch(PDO:: FETCH_ASSOC);
                                        $all_contact = $total_contact['all_contacts'];
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Contacts</span>
                                        <span class="info-box-number"><?php echo  $all_contact ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->


                            <!-- /.col -->
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
                                    <?php 
                                        $reviews = "SELECT count(*) AS all_reviews FROM reviews";
                                        $reviews_result = $con -> prepare($reviews);
                                        $reviews_result -> execute();
                                        $total_reviews = $reviews_result -> fetch(PDO:: FETCH_ASSOC);
                                        $all_reviews = $total_reviews['all_reviews'];

                                    
                                    ?>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Reviews</span>
                                        <span class="info-box-number"><?php echo $all_reviews ?></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>