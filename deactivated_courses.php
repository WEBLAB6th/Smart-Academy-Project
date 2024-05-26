<?php include "incs/auth.php" ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Deactivated Course List </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Deactivated Course List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Deactivated Course List</h3>
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
                if (isset($_SESSION['course_create_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['course_create_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['course_create_success']);  }
            
            ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-head-fixed">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Course</th>
                                <th>Description</th>
                                <th>Fee</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php 
                                $sn =1;
                                $sql = "SELECT * FROM courses WHERE status = '0'";
                                $result = $con -> prepare($sql);
                                $result -> execute();
                                foreach($result as $row ){ ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $row['course_name'] ?></td>
                                <td style="width: 300px; overflow: hidden;">
                                    <p class="description" style="overflow: hidden; max-height: 50px;">
                                        <?php echo $row['course_description'] ?>
                                    </p>
                                    <button class="btn btn-success btn-sm" onclick="toggleDescription(this)">Read
                                        More</button>
                                </td>
                                <td><?php echo $row['fee'] ?> PKR</td>
                                <td>
                                    <a href="#" onclick="openimageModal('<?php echo $row['image']; ?>')"><img src="uploads/<?php echo $row['image'] ?>" alt="" width="100"></a>
                                    <div id="imageModal" class="modal">
                                        <div class="modal-content">
                                            <img id="image" src="uploads/<?php echo $row['image'] ?>"
                                                alt="image">
                                            <span class="close" onclick="closeimageModal()">&times;</span>
                                        </div>
                                    </div>
       
                                </td>
                                <td><?php if ( $row['status'] == 1){
                                    echo "Active";
                                }else{
                                    echo "Deactivated";
                                } ?></td>
                                <td>
                                    <?php $id = $row['id'] ;
                                    $encodedId = base64_encode($id);
                                    ?>
                                    <a href="courses_update.php?id=<?php echo urldecode($encodedId) ?>"
                                        class="btn btn-success btn-sm" onclick="return confirm('Are you went to update this record')">Update</a>
                                    <a href="courses_delete.php?id=<?php echo urldecode($encodedId) ?>"
                                        class="btn btn-danger btn-sm" onclick="return confirm('Are you went to delete this record')">Delete</a>

                                </td>
                            </tr>
                            <?php  }
                             ?>
                        </tbody>


                    </table>

                </div>
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>