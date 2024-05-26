<?php 
    include "incs/auth.php";
    include "incs/header.php";
    include "incs/sidebar.php";

    $decodeId = $_GET['id'];
    $id = base64_decode($decodeId);
    $sql = "SELECT * FROM apply_form_students WHERE id =?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);
    $row = $result -> fetch(PDO::FETCH_ASSOC);

    
?>
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Certificate</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Certificate</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Certificate</h3>

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
                        <div >
                            <form action="generate_certificate_act.php" method="post" id="certificate">
                                <input type="hidden" name="student_id" id="student_id" class=" form-control" value="<?php echo $row['id'] ?>">
                                    
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="course_id" class="form-label">Course</label>
                                    </div>
                                    <?php 
                                        $course_id = $row['course_id'];
                                        $course = "SELECT * FROM courses WHERE id=?";
                                        $course_result = $con -> prepare($course);
                                        $course_result -> execute([$course_id]);
                                        $course_name = $course_result -> fetch(PDO::FETCH_ASSOC);
                                    
                                    ?>
                                    <div class="col-md-9">
                                        <input type="hidden" name="course_id" id="course_id" value="<?php echo $row['course_id'] ?>">
                                        <input type="text"  class=" form-control" value="<?php echo $course_name['course_name'] ?>" disabled>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="type_degree" class="form-label">Certificate/Diploma</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="type_degree" id="type_degree" class=" form-control" placeholder="Certificate/Diploma" oninput="convertToUpperCase(this)">
                                    </div>
                                </div>
                               
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="fname" class=" form-label">First Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="fname" id="fname" class=" form-control" value="<?php echo $row['fname'] ?>" >
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="lname" class=" form-label">Last Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="lname" id="lname" class=" form-control" value="<?php echo $row['lname'] ?>" >
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="father_name" class=" form-label">Father Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="father_name" id="father_name" class=" form-control" value="<?php echo $row['father_name'] ?>" >
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="address" class=" form-label">Address</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="address" id="address" class=" form-control" value="<?php echo $row['address'] ?>" >
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="date" class=" form-label">Date</label>
                                    </div>
                                    <div class="col-md-9">
                                        <?php $currentDate = date("Y-m-d"); ?>
                                        <input type="Date" name="date" id="date" class=" form-control" value="<?php echo $currentDate  ?>" >
                                    </div>
                                </div>
                                <div class="mt-3 float-right">
                                    <input type="submit" value="Generate Certificate" name="cert" class="btn btn-success ">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

</div>





<?php include "incs/footer.php"?>