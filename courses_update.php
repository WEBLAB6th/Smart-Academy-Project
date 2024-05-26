<?php include "incs/auth.php" ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<?php 
    $encode = $_GET['id'];
    $id =base64_decode($encode);
    $sql = "SELECT * FROM courses WHERE id =?";
    $result = $con -> prepare($sql);
    $result -> execute([$id]);
    $row = $result -> FETCH(PDO::FETCH_ASSOC);


?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Course </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Update Course</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Course</h3>
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
                if (isset($_SESSION['course_update_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['course_update_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['course_update_error']);  }
            
            ?>
            


            
            <div class="card-body">
            <form action="courses_update_act.php" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="course_name" class=" form-label">Course Name</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="course_name" id="course_name" placeholder="Enter your Course Name" class=" form-control" value="<?php echo $row['course_name'] ?>">
                        </div>

                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="course_description" class=" form-label">Course Description</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="course_description" id="course_description"
                                placeholder="Enter your Course Description" class=" form-control" rows="10"><?php echo $row['course_description'] ?></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="fee" class=" form-label">Course Fee</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="fee" id="fee" placeholder="Amount" class=" form-control" value="<?php echo $row['fee'] ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="image" class=" form-label">Image</label>
                        </div>
                        <div class="col-md-7">
                            <input type="file" name="image" id="image" class=" form-control">
                            <?php if (isset($_SESSION['update_extension_error'])){ ?>
                            <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                <?php echo $_SESSION['update_extension_error'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            </small>
                            <?php unset($_SESSION['update_extension_error']); } ?>
                            <?php if (isset($_SESSION['update_uploads_error'])){ ?>
                            <small class=" d-block mt-1 alert alert-danger alert-dismissible">
                                <?php echo $_SESSION['update_uploads_error'] ?>
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
                            </small>
                            <?php unset($_SESSION['update_uploads_error']); } ?>
                        </div>
                        <div class="col-md-2">
                            <img src="uploads/<?php echo $row['image'] ?>" alt="" width="100">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="status" class=" form-label">Status</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="status" id="status" class=" form-control" value="<?php echo $row['status'] ?>">
                        </div>
                    </div>
                    <div class="mt-3">
                        <input type="submit" name="update_course" value="Update"
                            class="btn btn-outline-success float-right pr-5 pl-5">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>