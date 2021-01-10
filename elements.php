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
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			<li><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Employees </a></li>
			<li class="active"><a href="elements.php"><em class="fa fa-navicon">&nbsp;</em> Jobs</a></li>
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
				<li class="active">Jobs</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Jobs</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class ="col-md-12">
				<div class ="col-md-12">
					<button type="button" name="add" id="add" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-warning">Add New Job</button>
					<br />
					<br />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12" >
				<div class="col-md-12">
					<table class="table table-bordered">
					<tr>  
						<th width="5%">View</th>
						<th width="20%">Job ID</th> 
						<th width="35%">Job Description</th>  
						<th width="35%">Assigned Employees</th> 
						<th width="5%">Delete</th> 
					</tr>
					</table>
				</div>
			</div>
		</div>


	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<link href="magic_suggest/magicsuggest-min.css" rel="stylesheet">
	<script src="magic_suggest/magicsuggest-min.js"></script>
</body>
</html>

<div id="add_data_Modal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <button type="button" class="close" data-dismiss="modal">&times;</button>  
                     <h4 class="modal-title">Add New Job</h4>  
                </div>  
                <div class="modal-body">  
                     <form method="post" enctype="multipart/form-data" id="insert_form">  
                          <input type="text" name="name" id="name" class="form-control" placeholder="Enter Job Name"/>  
                          <br />
						  <div id="description_job">
                          	<textarea type="text" name="description" id="description" class="form-control" placeholder="Enter Job Description"></textarea>
						  </div>
						  <br />
						  <br />
						  <label>Assign Employee/s to Job</label>
						  <div id="magicsuggest"></div>
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


 	<script>
		//Get data from database


		//Function for suggesting employees to add to list
			$('#magicsuggest').magicSuggest({
				placeholder: 'Select...',
				allowFreeEntries: false,
				data: [{
					id: 1,
					name: 'Location',
					nb: 34
				}, {
					id: 2,
					name: 'Keyword',
					nb: 106
				}],
				selectionPosition: 'bottom',
				selectionStacked: true,
				selectionRenderer: function(data){
					return data.name + ' (<b>' + data.nb + '</b>)';
				}
			});
	</script>
