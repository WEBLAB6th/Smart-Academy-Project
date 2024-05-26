<?php 
    include "incs/auth.php";
    include "incs/header.php";
    include "incs/sidebar.php";
   

?>






<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gallery</h3>

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
                if (isset($_SESSION['gallery_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['gallery_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['gallery_error']);  }
            
            ?>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-12">
                        <div>
                            <form action="gallery_create_act.php" method="POST" enctype="multipart/form-data">
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
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="student_name" class=" form-label">Student Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="student_name" id="student_name" class=" form-control"
                                            placeholder="Enter Student Name">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="job" class=" form-label">Job</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="job" id="job" class=" form-control"
                                            placeholder="Enter Job title">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="description" class=" form-label">Description</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="description" id="description" class=" form-control"
                                            placeholder="Description" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="images" class=" form-label">Images</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="images[]" id="images" class=" form-control"
                                            multiple="multiple">

                                        <?php if (isset($_SESSION['gallery_extension_error'])){ ?>
                                        <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                            <?php echo $_SESSION['gallery_extension_error'] ?>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">X</button>
                                        </small>
                                        <?php unset($_SESSION['gallery_extension_error']); } ?>

                                        <?php if (isset($_SESSION['gallery_uploads_error'])){ ?>
                                        <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                            <?php echo $_SESSION['gallery_uploads_error'] ?>
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">X</button>
                                        </small>
                                        <?php unset($_SESSION['gallery_uploads_error']); } ?>
                                    </div>
                                </div>
                              

                                <div class=" float-right mt-3">
                                    <input type="submit" value="Create Gallery" name="create_gallery"
                                        class="btn btn-success btn-sm">
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