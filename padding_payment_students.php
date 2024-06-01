<?php include "incs/auth.php" ?>

<?php include "incs/header.php" ?>
<?php include "incs/sidebar.php" ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Padding Payment Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active">Padding Payment Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Padding Payment Students</h3>
                <div class="card-tools">
                    <form style="  margin-right: 30px;" >
                        <div class="row">
                            <div class="col-md-12">
                                <input type="search" size="30px" name="search" id="search" class=" form-control"
                                    placeholder="Search">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">

                <div class=" table-responsive mb-5" id="table-data"></div>

                <div class=" table-responsive mb-5">
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
                                    Email
                                </th>
                                <th>
                                    Phone Number
                                </th>
                                <th>
                                    Address
                                </th>
                                <th>
                                    Qualification
                                </th>
                                <th>
                                    Fee
                                </th>
                                <th>
                                    R ID
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sn=1;
                                $sql = "SELECT * FROM apply_form_students WHERE status='Pending'";
                                $result = $con -> prepare($sql);
                                $result -> execute();
                                foreach ($result as $row){ 
                                $course_id = $row['course_id'];
                                $course = "SELECT * FROM courses WHERE id=?";
                                $course_result = $con -> prepare($course);
                                $course_result -> execute([$course_id]);
                                $course_name = $course_result -> fetch(PDO::FETCH_ASSOC);
                                $name = $course_name['course_name'];
                                $fee = $course_name['fee'];

                                
                                ?>
                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $name ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['fname'] ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['lname'] ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['father_name'] ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['email'] ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['pnumber'] ?></td>
                                <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php echo $row['address'] ?></td>
                                <td><?php echo $row['qualification'] ?></td>
                                <?php $submit_fee = $row['fee'];
                                $b_fee = $fee - $submit_fee ;
                                ?>
                                <td class="text-center"><?php echo $submit_fee?>PKR/<?php echo $fee?>PKR

                                    <?php if ($b_fee > 0){ ?>
                                    <span class="text-danger"><?php echo $b_fee ?> PKR</span>
                                    <?php }else{
                                        
                                    } ?>
                                </td>

                                <td style="max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                    <?php if ($row['r_id']==NULL) {
                                    echo "<span class='text-danger'>No File Uploaded</span>";
                                }else{ ?>
                                   
                                    <a href="#"
                                    onclick="openReceiptModal('<?php echo $row['r_id']; ?>')">View
                                    Receipt</a>
                                    <div id="ReceiptModal" class="modal">
                                        <div class="modal-content">
                                            <img id="ReceiptImage"
                                                src="uploads/<?php echo $row['r_id']; ?>" alt="Receipt">
                                            <span class="close" onclick="closeReceiptModal()">&times;</span>
                                        </div>
                                    </div>
                                <?php }  ?></td>
                                <?php 

                                if ($b_fee > 0 ){ 

                                    $update_id =$row['id'];
                                    $status = "UPDATE apply_form_students SET status = ?  WHERE id=?";
                                    $status_result = $con -> prepare($status);
                                    $status_result -> execute(['Pending',$update_id]); ?>

                                <td>
                                    <?php echo "<span class='bg-danger text-uppercase p-1'>". $row['status'] ."</span>";?>
                                    <script>
                                    window.onload = function() {
                                        if (!window.location.hash) {
                                            window.location = window.location + '#loaded';
                                            window.location.reload();
                                        }
                                    }
                                    </script>
                                </td>

                                <?php }else {
                                    
                                    $update_id =$row['id'];
                                    $status = "UPDATE apply_form_students SET status = ?  WHERE id=?";
                                    $status_result = $con -> prepare($status);
                                    // $status_result -> execute(['Progress',$update_id]);
                                    
                                    if ($row['status'] != 'Completed') {
                                        $status_result->execute(['Progress', $update_id]);
                                    }
                                    
                                    ?>

                                <td>

                                    <?php
                                        echo "<span class='bg-success text-uppercase p-1'>" . $row['status'] . "</span>";

                                        if ($row['status']=='Completed'){

                                            $check_certificate = "SELECT student_id FROM certificate_details";
                                            $check_certificate_result = $con -> prepare($check_certificate);
                                            $check_certificate_result -> execute();
                                            $certificate_student_ids = $check_certificate_result->fetchAll(PDO::FETCH_COLUMN);

                                            if(!in_array($row['id'], $certificate_student_ids)){
                                                $id = $row['id'];
                                                $encodeId = base64_encode($id); ?>
                                                <a class='btn btn-danger btn-sm mt-2'
                                                href='generate_certificate.php?id=<?PHP echo urlencode($encodeId) ?>'>Certificate</a>
                                        <?PHP } else{ 

                                                $students_id =$row['id'];
                                                $date_sql = "SELECT * FROM certificate_details WHERE student_id=?";
                                                $date_result = $con -> prepare($date_sql);
                                                $date_result -> execute([$students_id]);
                                                $date_data=$date_result -> fetch(PDO::FETCH_ASSOC);
                                                $date = $date_data['date'];
                                                ?>
                                    <small class="bg-warning " style="padding-left: 21px; padding-right: 21px;">Received
                                        <br></small>
                                    <small class="text-danger bg-warning"><?php echo $date ?></small>
                                    <?php  } 
                                        } ?>
                                    <script>
                                    window.onload = function() {
                                        if (!window.location.hash) {
                                            window.location = window.location + '#loaded';
                                            window.location.reload();
                                        }
                                    }
                                    </script>
                                </td>

                                <?php }  ?>
                                <td style="width: 200px;">
                                    <?php $id = $row['id'];
                                    $encodeId = base64_encode($id);  ?>
                                    <a href="apply_form_students_update.php?id=<?php echo urlencode($encodeId) ?>"
                                        class="btn btn-success btn-sm mb-1"
                                        onclick="return confirm('Are you went update this record')">Update</a>
                                    <a href="apply_form_students_delete.php?id=<?php echo urlencode($encodeId) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you Went to Delete this record')">Delete</a>
                                </td>
                            </tr>
                            <?php  } ?>
                           
                        </tbody>
                    </table>
                </div>

               
            </div>
        </div>
    </section>
</div>



<?php include "incs/footer.php" ?>