<?php 

	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
	}

	include_once("databaseconnect.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Whitestar Products - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Whitestarproducts</span>Admin</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Neil Stubbing</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>


		<ul class="nav menu">
			<li class="active"><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Employees </a></li>
			<li><a href="elements.php"><em class="fa fa-navicon">&nbsp;</em> Jobs</a></li>
			<li><a href="elements.php"><em class="fa fa-toggle-off">&nbsp;</em> Products</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Jobs <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Active Jobs
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Active Jobs
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Completed Jobs
					</a></li>
				</ul>
			</li> -->
			<li><a href="login/login.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Employees</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Employees</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
							<div class="large">31</div>
							<div class="text-muted">Jobs Completed Today</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
							<div class="large">67</div>
							<div class="text-muted">Product Notifications</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<div class="large">4</div>
							<div class="text-muted">New Users</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
							<div class="large">45</div>
							<div class="text-muted">To Do</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>

		<div class="container_employees" style="width:80%;margin:auto;">
			<div class="table-responsive">  
					<div align="right">  
						<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add Employee</button>
						<input type="button" name="train" value="Train Person Group" id="train" class="btn btn-success train" />
						<br />
						<br />
						<span id="training_status"><?php include("get_training_status.php"); ?></span>
					</div>  
					<br />  
					<div id="employee_table">  
						<?php 
							// Get data from database
							$sql = "SELECT * FROM employees";
							$result = $conn->query($sql);				
						?>  
						<table class="table table-bordered">  
							<tr>  
								<th width="5%">View</th> 
								<th width="75%">Employee Name</th>  
								<th width="5%">Edit</th> 
								<th width="5%">Delete</th> 
								 
							</tr> 
							<?php 
								while($row = $result->fetch_assoc()) {
							?>
									<tr>  
										<td><input type="button" name="view" value="view" id="<?php echo $row['employee_id']?>" class="btn btn-info btn-xs view_data" /></td>
										<td><?php echo $row['employee_name']; ?></td>  
										<td><input type="button" name="edit" value="Edit" id="<?php echo $row['employee_id']?>" class="btn btn-info btn-xs edit_data" /></td>  
										<td><input type="button" name="delete" value="delete" id="<?php echo $row['employee_id']?>" class="btn btn-danger btn-xs delete_data" /></td>  
									</tr>
									<input id="name_<?php echo $row['employee_id']?>" type="hidden" value="<?php echo $row['employee_name'] ?>" />
							<?php } ?>
						</table>
					</div>  
			</div>
		</div>




		
	</div>	<!--/.main-->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		// window.onload = function () {
		// 	var chart1 = document.getElementById("line-chart").getContext("2d");
		// 	window.myLine = new Chart(chart1).Line(lineChartData, {
		// 	responsive: true,
		// 	scaleLineColor: "rgba(0,0,0,.2)",
		// 	scaleGridLineColor: "rgba(0,0,0,.05)",
		// 	scaleFontColor: "#c5c7cc"
		// 	});
		// };
	</script>		
</body>
</html>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Employee Details</h4>  
                </div>  
                <div class="modal-body" id="employee_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>
 <div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Add Whitestarproducts Employee</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" enctype="multipart/form-data" id="insert_form">  
                          <label>Enter Employee Name</label>  
                          <input type="text" name="name" id="name" class="form-control" />  
                          <br />
						  <label>Employee Description</label>  
                          <input type="text" name="description" id="description" class="form-control" />
						  <br />
						  <label>Train Face/s for this employee</label>
							<input type="file" name="multiple_files[]" id="multiple_files" multiple />
							<span class="text-muted">Only .jpg, png, .gif file allowed</span>
							<span id="error_multiple_files"></span>
						  <br />
						  <br />
                          <input type="hidden" name="employee_id" id="employee_id" />  
                          <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success" />  
                     </form>  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
           </div>  
      </div>  
 </div>

 <div id="delete_Modal" class="modal fade">
	<div class="modal-dialog">  
		<div class="modal-content">  
			<div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal">&times;</button>  
					<h4 id="delete_employee_title" class="modal-title"></h4>  
			</div>  
			<div class="modal-body">  
					<form method="post" id="delete_form">
						<input type="hidden" name="employee_id" id="employee_id_for_delete" /> 
						<input type="submit" name="delete" id="delete_person" value="Delete" class="btn btn-success" /> 
						<input type="button" data-dismiss="modal" value="Cancel" class="btn btn-danger" />
					</form>  
			</div>
		</div>  
	</div>
 </div>








 <script>
 	$(document).ready(function(){
		$(document).on('click', '.delete_data', function(){
			var employee_id = $(this).attr("id");
			var employee_name = document.getElementById("name_"+employee_id).value;

			$('#delete_Modal').modal('show');
			document.getElementById("delete_employee_title").innerHTML = "Are you sure you want to delete employee, <br><b>"+employee_name+"</b><br><br>This will remove all data associated with this employee.";
			document.getElementById("employee_id_for_delete").value = employee_id;
		});

		$(document).on('click', '.view_data', function(){  
			var employee_id = $(this).attr("id");  
			if(employee_id != '')  
			{  
					$.ajax({  
						url:"select.php",  
						method:"POST",  
						data:{employee_id:employee_id},  
						success:function(data){  
							$('#employee_detail').html(data); 
							$('#dataModal').modal('show'); 
						}  
					});  
			}            
		}); 

		$(document).on('click', '.train', function(){ 
			$.ajax({  
				url: "train.php",  
				method:"POST", 
				beforeSend:function(){  
					$('#train').val("Training, Please wait..");  
				},
				success:function(){
					$('#train').val("Train Person Group");
					training_status();
				}  
			});           
		}); 


		function training_status() {
			$.ajax({
				url: 'get_training_status.php',
				method: 'POST',
				success:function(data) {
					$('#training_status').html(data);
				}
			});
		}


		$('#add').click(function(){  
           $('#insert').val("Insert");  
           $('#insert_form')[0].reset();  
      	}); 


		$('.delete_data').click(function(){  
			$('#delete_person').val("Delete");  
			$('#delete_form')[0].reset();  
      	}); 

		$('#insert_form').submit(function(event){  
			event.preventDefault();  
			if($('#name').val() == ""){  
				alert("Name is required");  
			} 

			var error_images = ''; //accessible in other functions
			var files = $('#multiple_files')[0].files;
			// formData.append('section', 'name');
			// // formData.append('section', 'description');
			// // Attach file
			// for(var i=0; i<files.length; i++) {
			// 	formData.append("file[]", document.getElementById('multiple_files').files[i]);
			// }

			if(files.length > 10){
				error_images += 'You can not select more than 10 files';
			}
			else
			{
				for(var i=0; i<files.length; i++){
					var name = document.getElementById("multiple_files").files[i].name;
					var ext = name.split('.').pop().toLowerCase();

					if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
						error_images += '<p>Invalid '+i+' File</p>';
					}
					var oFReader = new FileReader();
					oFReader.readAsDataURL(document.getElementById("multiple_files").files[i]);
					var f = document.getElementById("multiple_files").files[i];
					var fsize = f.size||f.fileSize;
					if(fsize > 6000000){
						error_images += '<p>' + i + ' File Size is too big, only images below 6mb are allowed</p>';
					}
				}
			}

			if(error_images == '') {  
				$.ajax({  
					url:"insert.php",  
					method:"POST",  
					data: new FormData(this), 
					cache: false,
					contentType: false,
					processData: false, 
					beforeSend:function(){  
						$('#insert').val("Inserting, Please wait..");  
					},  
					success:function(data){  
						$('#insert_form')[0].reset();  
						$('#add_data_Modal').modal('hide');  
						$('#employee_table').html(data);  
					}  
				});  
			}
			else {
				$('#multiple_files').val('');
				$('#error_multiple_files').html("<span class='text-danger'>"+error_images+"</span>");
				return false;
			}  
		});  

		$('#delete_form').on("submit", function(event){  
			event.preventDefault();
			$.ajax({  
				url:"delete.php",  
				method:"POST",  
				data:$('#delete_form').serialize(),  
				beforeSend:function(){  
					$('#delete_person').val("Deleting...");  
				},  
				success:function(data){ 
					document.getElementById("delete_person").value = "Delete"; 
					$('#delete_form')[0].reset();  
					$('#delete_Modal').modal('hide');  
					$('#employee_table').html(data);  
				}  
			});  
		});
			 

	});

		
	</script>
 