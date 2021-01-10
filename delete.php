<?php  
function debug_to_console( $data ) {
     $output = $data;
     if ( is_array( $output ) )
          $output = implode( ',', $output);

     echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

include("face_api_functions.php");

$employee_delete = $_POST["employee_id"];

$connect = mysqli_connect("localhost", "id14886851_whitestar_admin", "JobCoster@aut0", "id14886851_whitestarproducts_admin");

// FIRST DELETE FROM COGNITIVE SERVICE
$execute_delete = callAPI('DELETE', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/persons/'.$employee_delete, "");

// THEN DELETE FROM DATABASE
// $employee_delete_escaped = mysqli_real_escape_string($connect, $employee_delete);
$query = "DELETE FROM `employees` WHERE `employee_id` = '$employee_delete'";  


// DELETE ALL FACES
$query_check = "SELECT * FROM faces";
$result_check = mysqli_query($connect, $query_check);
while($row = mysqli_fetch_array($result_check)) {
     if($row["employee_id"] == $employee_delete) {
          unlink("faces/".$row["employee_faces"]); //delete the files associated with that employee first
     }
}
// DELETE FACES FROM DATABASE
$query2 = "DELETE FROM `faces` WHERE `employee_id` = '$employee_delete'";


$message = 'Employee Deleted Successfully.';



if(mysqli_query($connect, $query) && mysqli_query($connect, $query2))  {
    $output .= '<label class="text-success">' . $message . '</label>';  
           $select_query = "SELECT * FROM employees ORDER BY id DESC";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table table-bordered">  
                     <tr>  
                         <th width="5%">View</th> 
                         <th width="75%">Employee Name</th>  
                         <th width="5%">Edit</th> 
                         <th width="5%">Delete</th>  
                     </tr>  
           ';  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '  
                     <tr>  
                         <td><input type="button" name="view" value="view" id="' . $row["employee_id"] . '" class="btn btn-info btn-xs view_data" /></td>
                          <td>' . $row["employee_name"] . '</td>  
                          <td><input type="button" name="edit" value="Edit" id="'.$row["employee_id"] .'" class="btn btn-info btn-xs edit_data" /></td> 
                          <td><input type="button" name="delete" value="delete" id="'.$row["employee_id"].'" class="btn btn-danger btn-xs delete_data" /></td>  
                     </tr>
                     <input id="name_'.$row["employee_id"].'" type="hidden" value="'.$row["employee_name"].'" />
                ';  
           }  
           $output .= '</table>';  
}  
    echo $output;

?>