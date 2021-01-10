<?php  
include_once("databaseconnect.php");

if(isset($_POST["employee_id"]))  
{  
$sql = "SELECT * FROM employees";
$sql2 = "SELECT * FROM faces";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);

    $output .= '  
    <div class="table-responsive">  
        <table class="table table-bordered">';  
    while($row = $result->fetch_assoc())  
    {  
        if($_POST["employee_id"] == $row["employee_id"]) {
        $output .= '  
                <tr>  
                    <td width="30%"><label>Person ID</label></td>  
                    <td width="70%">'.$row["employee_id"].'</td>  
                </tr>  
                <tr>  
                    <td width="30%"><label>Name</label></td>  
                    <td width="70%">'.$row["employee_name"].'</td>  
                </tr>
                <tr>  
                    <td width="30%"><label>Associated Faces</label></td>  
                    <td width="70%">
                        <div style="overflow-x:auto; width:400px">';
                            //SHOW IMAGES ASSOCIATED WITH USER:
                            while($row2 = $result2->fetch_assoc()) {
                                if($_POST["employee_id"] == $row2["employee_id"]) {
                                    $output .= '<img style="height:90px; width:70px;" src="faces/'.$row2["employee_faces"].'">';
                                }
                            }
        $output .=  '   </div>
                    </td>  
                </tr>
        ';  
        }
    }  
    $output .= '  
        </table>  
    </div>  
    ';  
    echo $output;  
}  
 ?>