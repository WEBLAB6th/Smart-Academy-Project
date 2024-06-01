<?php 
    session_start();
    include "incs/db.php";

   					

    $search_value = $_POST['search']; 

    $sql = "SELECT * FROM certificate_details WHERE";
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
        <tbody>";

        while($row = $result -> fetch(PDO::FETCH_ASSOC)){
            $course_id=$row['course_id'];
            $course = "SELECT * FROM courses WHERE id=?";
            $course_result = $con -> prepare($course);
            $course_result -> execute([$course_id]);
            $course_name = $course_result -> fetch(PDO::FETCH_ASSOC);
            $course_name = $course_name['course_name'];
           $output .= "<tr>
                <td>{$sn}</td>
                <td>{$course_name}</td>
                <td>{$row['fname']}</td>
                <td>{$row['lname']}</td>
                <td>{$row['father_name']}</td>
                <td>{$row['address']}</td>
                <td>
                    <a href='#' onclick=\"openCertificateModal('{$row['certificate']}')\">View Certificate</a>/
                    <div id='certificateModal' class='modal'>
                        <div class='modal-content'>
                            <img id='certificateImage' src='uploads/{$row['certificate']}' alt='Certificate'>
                            <span class='close' onclick='closeCertificateModal()'>&times;</span>
                        </div>
                    </div>
                    <a href='uploads/{$row['certificate']}' download='download'>Download <i class='fa fa-download' aria-hidden='true'></i></a>
                </td>
                <td>{$row['date']}</td>
                <td>";
                $certificate_id = $row['id'];
                $certificate_encodeId = base64_encode( $certificate_id);
                $output .=" <a href='certificate_data_delete.php?id=" . urlencode($certificate_encodeId) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>";
                "</td>
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
