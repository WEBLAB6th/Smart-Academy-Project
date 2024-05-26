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
                if (isset($_SESSION['gallery_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['gallery_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['gallery_success']);  }
            
            ?>

            <?php 
                if (isset($_SESSION['gallery_delete_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['gallery_delete_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['gallery_delete_success']);  }
            
            ?>

            <?php 
                if (isset($_SESSION['gallery_update_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['gallery_update_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['gallery_update_success']);  }
            
            ?>

            <?php 
                if (isset($_SESSION['gallery_delete_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['gallery_delete_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['gallery_delete_error']);  }
            
            ?>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" table-responsive">
                            <table class=" table table-bordered table-head-fixed">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Course
                                        </th>
                                        <th>
                                            Student
                                        </th>
                                        <th>
                                            Job
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Images
                                        </th>
                                        <th>
                                            Videos
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $sn = 1;
                                    $sql = "SELECT * FROM gallery";
                                    $result = $con -> prepare($sql);
                                    $result -> execute();
                                    foreach ($result as $kye => $row){ 

                                        $course_id = $row['course_id'];
                                        $course = "SELECT * FROM courses WHERE id=?";
                                        $course_result = $con -> prepare($course);
                                        $course_result -> execute([$course_id]);
                                        $course_name = $course_result -> fetch(PDO::FETCH_ASSOC);
                                        $name = $course_name['course_name'];
                                        
                                        
                                        ?>
                                    <tr>
                                        <td>
                                            <?php echo $sn++ ?>
                                        </td>
                                        <td>
                                            <?php echo  $name  ?>
                                        </td>
                                        <td>
                                            <?php echo $row['student_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['job'] ?>
                                        </td>

                                        <td style="width: 200px; overflow: hidden;">
                                            <p class="description" style="overflow: hidden; max-height: 50px;">
                                                <?php echo $row['description'] ?>
                                            </p>
                                            <button class="btn btn-success btn-sm"
                                                onclick="toggleDescription(this)">Read
                                                More</button>
                                        </td>

                                        <td>
                                            <?php 
                                                $images = explode(',',$row['images']);
                                            foreach($images as $key => $image){ ?>
                                            <a href="#" onclick="openimageModal('<?php echo $image ?>')"><img
                                                    src="uploads/<?php echo $image ?>" alt="" width="70"></a>

                                            <div id="imageModal" class="modal">
                                                <div class="modal-content">
                                                    <img id="image" src="uploads/<?php echo $image?>" alt="image">
                                                    <span class="close" onclick="closeimageModal()">&times;</span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </td>
                                     
                                        <td style="width: 145px;">
                                        <?php 
                                            $id =$row['id'];
                                            $encodeId = base64_encode($id);
                                        ?>
                                            <a href="gallery_update.php?id=<?php echo urldecode($encodeId) ?>" class="btn btn-success btn-sm">Update</a>
                                            <a href="gallery_delete.php?id=<?php echo urldecode($encodeId)?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete This Record')">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

</div>








<?php include "incs/footer.php" ?>