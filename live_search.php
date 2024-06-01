<?php 
    session_start();
    include "incs/db.php";

    $search_value = $_POST['search']; 

    // $sql = "SELECT * FROM apply_form_students WHERE fname LIKE '%{$search_value}%' OR lname LIKE '%{$search_value}%' OR father_name LIKE '%{$search_value}%'";

    $sql = "SELECT * FROM apply_form_students WHERE ";
    if (strpos($search_value, ' ') !== false) {
        list($first_name, $last_name) = explode(' ', $search_value, 2);
        $sql .= "(fname LIKE '%$first_name%' AND lname LIKE '%$last_name%')";
    } else {
        
        $sql .= "(fname LIKE '%$search_value%' OR lname LIKE '%$search_value%')";
    }

    $result = $con -> prepare($sql);
    $result -> execute();
    $output="";
    $sn=1;
    if($result -> rowCount() > 0){

        $output= "<table class='table table-bordered text-center'>
        <thead>
            <tr>
                <th>
                    #
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
        <tbody>";

        while($row = $result -> fetch(PDO::FETCH_ASSOC)){
            $course_id=$row['course_id'];
            $course = "SELECT * FROM courses WHERE id=?";
            $course_result = $con -> prepare($course);
            $course_result -> execute([$course_id]);
            $course_name = $course_result -> fetch(PDO::FETCH_ASSOC);
            $course_name = $course_name['course_name'];
            $output .= "<tr>
                            <td>
                                $sn
                            </td>
                            <td>
                                $course_name
                            </td>
                            <td>
                                {$row['fname']}
                            </td>
                            <td>
                                {$row['lname']}
                            </td>
                            <td>
                                {$row['father_name']}
                            </td>
                            <td>
                                {$row['email']}
                            </td>
                            <td>
                                {$row['pnumber']}
                            </td>
                            <td>
                                {$row['address']}
                            </td>
                            <td>
                                {$row['qualification']}
                            </td>
                            <td>
                                {$row['fee']}RS
                            </td>
                            <td>";
                            if ($row['r_id'] == NULL) {
                                $output .= "<span class='text-danger'>No File Uploaded</span>";
                            } else {
                                $output .= "<a href='#' onclick='openReceiptModal(\"{$row['r_id']}\")'>View Receipt</a>
                                    <div id='ReceiptModal' class='modal'>
                                        <div class='modal-content'>
                                            <img id='ReceiptImage' src='uploads/{$row['r_id']}' alt='Receipt'>
                                            <span class='close' onclick='closeReceiptModal()'>&times;</span>
                                        </div>
                                    </div>";
                            }
                            $output .= " </td>
                            <td>";
                            if ($row['status']=='Completed'){
                                
                                $output .= "<span class='bg-success text-uppercase p-1'>{$row['status']}</span>";
                                $check_certificate = "SELECT student_id FROM certificate_details";
                                $check_certificate_result = $con -> prepare($check_certificate);
                                $check_certificate_result -> execute();
                                $certificate_student_ids = $check_certificate_result->fetchAll(PDO::FETCH_COLUMN);
                                
                                // var_dump($row['id'], $certificate_student_ids);
                                // die();
                                if(!in_array($row['id'], $certificate_student_ids)){

                                    $id = $row['id'];
                                    $encodeId = base64_encode($id);
                                    $output .= "<a class='btn btn-danger btn-sm mt-2' href='generate_certificate.php?id=" . urlencode($encodeId) . "'>Certificate</a>";
                                } else{

                                    $students_id =$row['id'];
                                    $date_sql = "SELECT * FROM certificate_details WHERE student_id=?";
                                    $date_result = $con -> prepare($date_sql);
                                    $date_result -> execute([$students_id]);
                                    $date_data=$date_result -> fetch(PDO::FETCH_ASSOC);
                                    $date = $date_data['date'];

                                    $output .="<small class='bg-warning d-block mt-1' style='padding-left: 21px; padding-right: 21px;'>Received
                                        <br></small>
                                    <small class='text-danger bg-warning'>".$date ."</small>";
                                }

                            }elseif($row['status']=='Progress'){
                                $output .= "<span class='bg-success text-uppercase p-1'>{$row['status']}</span>";

                            }else{
                                $output .= "<span class='bg-danger text-uppercase p-1'>{$row['status']}</span>";
                            }
                                
                            $output .= "  </td>
                            <td>";
                            $id = $row['id'];
                            $encodeId = base64_encode($id);
                            
                            $output .= "<a href='apply_form_students_update.php?id=" . urlencode($encodeId) . "'
                                class='btn btn-success btn-sm mb-1'>Update</a>
                            <a href='apply_form_students_delete.php?id=" . urlencode($encodeId) . "'
                                class='btn btn-danger btn-sm'
                                onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>

                        </tr>";

            // Increment the $sn value for the next iteration
            $sn++;
        }
        
        $output .= "</tbody></table> <hr class='border border-3 border-danger'>";
        echo $output;
    } else {
        echo "<h3 class='text-danger text-center'>No Data Found</h3>";
    }
?>
