<?php
 include "incs/auth.php" ?>
<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>


<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Graduate Students </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Graduate Students</li>
                    </ol>
                </div>
            </div>
        </div>

    </section>


    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <i> Graduate Students </i></h3>

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
                if (isset($_SESSION['certificate_delete_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['certificate_delete_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['certificate_delete_success']);  }
            
            ?>

            <?php 
                if (isset($_SESSION['generate_certificate_success'])){ ?>
            <div class=" alert alert-success alert-dismissible">
                <?php echo $_SESSION['generate_certificate_success'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['generate_certificate_success']);  }
            
            ?>

            

            <?php 
                if (isset($_SESSION['certificate_delete_error'])){ ?>
            <div class=" alert alert-danger alert-dismissible">
                <?php echo $_SESSION['certificate_delete_error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
            </div>
            <?php unset($_SESSION['certificate_delete_error']);  }
            
            ?>

            <div class="card-body">
                <div class="mt-5">
                    <h3></h3>
                    <form style="margin-right: 30px; margin-top: -40px;  float: right;">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="search" size="30px" name="search" id="search_cert" class=" form-control"
                                    placeholder="Search">
                            </div>
                        </div>
                    </form>
                </div>
                <div class=" table-responsive mb-5" id="table-data-cert"></div>

                <div class=" table-responsive mt-5">
                    <table class="table table-bordered text-center">
                        <thead class="w-100">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Course
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th>
                                <th>
                                    Father Name
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Certificate
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sn=1;
                                $graduate_sql = "SELECT * FROM certificate_details";
                                $graduate_result = $con -> prepare($graduate_sql);
                                $graduate_result -> execute();
                                foreach($graduate_result as $get_data){

                                $cours_id = $get_data['course_id'];
                                $course_sql = "SELECT * FROM courses WHERE id=?";
                                $course_result_second = $con -> prepare($course_sql);
                                $course_result_second -> execute([$cours_id]);
                                $course_name = $course_result_second -> fetch(PDO::FETCH_ASSOC);
                                $name_course = $course_name['course_name']; ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $name_course ?></td>
                                <td><?php echo $get_data['fname'] ?></td>
                                <td><?php echo $get_data['lname'] ?></td>
                                <td><?php echo $get_data['father_name'] ?></td>
                                <td><?php echo $get_data['address'] ?></td>
                                <td>
                                    <a href="#"
                                        onclick="openCertificateModal('<?php echo $get_data['certificate']; ?>')">View
                                        Certificate</a>/
                                    <div id="certificateModal" class="modal">
                                        <div class="modal-content">
                                            <img id="certificateImage"
                                                src="uploads/<?php echo $get_data['certificate']; ?>" alt="Certificate">
                                            <span class="close" onclick="closeCertificateModal()">&times;</span>
                                        </div>
                                    </div>


                                    <a href="uploads/<?php echo $get_data['certificate'] ?>"
                                        download="download">Download <i class="fa fa-download"
                                            aria-hidden="true"></i></a>
                                </td>
                                <td>
                                    <?php
                                        echo $get_data['date']; 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $certificate_id = $get_data['id'];
                                        $certificate_encodeId = base64_encode( $certificate_id);
                                    ?>
                                    <a class="btn btn-danger btn-sm"
                                        href="certificate_data_delete.php?id=<?php echo urlencode($certificate_encodeId) ?>">Delete</a>
                                </td>

                            </tr>
                            <?php  }  ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

</div>
<?php include "incs/footer.php" ?>