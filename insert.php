<?php  
function debug_to_console( $data ) {
     $output = $data;
     if ( is_array( $output ) )
          $output = implode( ',', $output);

     echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

$connect = mysqli_connect("localhost", "id14886851_whitestar_admin", "JobCoster@aut0", "id14886851_whitestarproducts_admin");

 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $name = mysqli_real_escape_string($connect, $_POST["name"]);
      $description =  mysqli_real_escape_string($connect, $_POST["description"]);

      if($_POST["employee_id"] != '')  
      {  // Update existing Employee
           $query = "  
           UPDATE tbl_employee   
           SET name='$name',  
           description = '$description',
           WHERE id='".$_POST["employee_id"]."'";  
           $message = 'Data Updated';  
      }  
      else  
      {   
          include("face_api_functions.php");
           // Create a new Employee

          //FIRST CREATE THE EMPLOYEE USING API
          $data_array = array(
               "name" => $name,
               "userData" => $description
          );
          $create_employee = callAPI('POST', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/persons', json_encode($data_array));
          $response = json_decode($create_employee, true);
          $new_employee_id = mysqli_real_escape_string($connect, $response["personId"]);

          //THEN INSERT INTO DATABASE
           $query = 
           "INSERT INTO `employees` (`employee_name`, `employee_id`, `description`) 
           VALUES('$name', '$new_employee_id', '$description');";  
           $message = 'Data Inserted';  
      }
      


     if(count($_FILES["multiple_files"]["name"]) > 0){
     //$output = '';
          for($count=0; $count<count($_FILES["multiple_files"]["name"]); $count++){
               $file_name = basename( $_FILES["multiple_files"]["name"][$count]);
               //UPLOAD THE IMAGE NAMES TO THE DATABASE
               $tmp_name = $_FILES["multiple_files"]['tmp_name'][$count];
               $destination_path = "faces/";
               $target_path = $destination_path . $file_name;

               $file_array = explode(".", $file_name);
               $file_extension = end($file_array);
               $query_check = "SELECT * FROM faces";
               $result_check = mysqli_query($connect, $query_check);
               while($row = mysqli_fetch_array($result_check)) {
                    if($row["employee_faces"] == $file_name) {
                         $file_name = $file_array[0] . rand() . '.' . $file_extension;
                         $target_path = $destination_path . $file_name;
                    }
               }
               
               if(move_uploaded_file($tmp_name, $target_path)){
                    $query2 = "INSERT INTO `faces` (`employee_id`, `employee_faces`)VALUES ('$new_employee_id', '$file_name')";
                    // Execute insert to database
                    mysqli_query($connect, $query2);

                    //ADD FACES TO THE USER
                    $data_array2 = array(
                         "url" => 'https://whitestarproducts.000webhostapp.com/faces/'.$file_name
                    );
                    $add_faces = callAPI('POST', 'https://westus2.api.cognitive.microsoft.com/face/v1.0/persongroups/employees/persons/'.$new_employee_id.'/persistedFaces?detectionModel=detection_01', json_encode($data_array2));
               }
          }
     }

      if(mysqli_query($connect, $query))  
      {  
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
 }  
 ?>