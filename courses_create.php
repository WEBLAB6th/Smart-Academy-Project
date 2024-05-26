<?php include "incs/auth.php" ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Course </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Create Course</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Course</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <?php if (isset($_SESSION['course_create_error'])){ ?>
            <div class=" d-block mt-1 alert alert-danger alert-dismissible">
                <?php echo $_SESSION['course_create_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['course_create_error']); } ?>
            <div class="card-body">
                <form action="courses_create_act.php" method="POST" enctype="multipart/form-data" id="course">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="course_name" class=" form-label">Course Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="course_name" id="course_name" placeholder="Enter your Course Name"
                                class=" form-control">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="course_description" class=" form-label">Course Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="course_description" id="course_description"
                                placeholder="Enter your Course Description" class=" form-control" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="fee" class=" form-label">Course Fee</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fee" id="fee" placeholder="Amount" class=" form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="image" class=" form-label">Image</label>
                        </div>
                        <div class="col-md-9">
                            <input type="file" name="image" id="image" class=" form-control">

                            <?php if (isset($_SESSION['extension_error'])){ ?>
                            <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                <?php echo $_SESSION['extension_error'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            </small>
                            <?php unset($_SESSION['extension_error']); } ?>
                            
                            <?php if (isset($_SESSION['uploads_error'])){ ?>
                            <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                <?php echo $_SESSION['uploads_error'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            </small>
                            <?php unset($_SESSION['uploads_error']); } ?>

                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="status" class=" form-label">Status</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="status" id="status" class=" form-control">
                        </div>
                    </div>
                    <div class=" float-right mt-3">
                        <input type="submit" name="create_course" value="Add Course"
                            class="btn btn-success btn-sm ">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>