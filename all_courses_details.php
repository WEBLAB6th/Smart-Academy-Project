<?php 
include "incs/auth.php";
?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>


<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All courses Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All courses Details</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <i> All courses Details </i></h3>

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


                    <?php
                    $index = 0;
                    $course_details = "SELECT * FROM courses";
                    $courses_details_result = $con-> prepare($course_details);
                    $courses_details_result -> execute();
                    $course_fetch = $courses_details_result -> fetchAll(PDO::FETCH_ASSOC);
                    foreach($course_fetch AS  $row){ 

                        $course_id = $row['id'];
                                   
                        // Count the total students
                        $total_students_query = "SELECT COUNT(*) as total_course_students FROM apply_form_students WHERE  course_id= ?";
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
                </div>

            </div>

        </div>

    </section>

</div>
<?php include "incs/footer.php" ?>