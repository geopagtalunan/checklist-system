<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8; X-Content-Type-Options=nosniff">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CHECKLIST CREATOR</title>
	<link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="../assets/css/animate.min.css">
    <!-- Custom styles for this template -->
    <link href="../assets/css/custom.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap.css"rel="stylesheet">
	<link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	
	
</head>

<body style="width:100%;padding:20px">





<div class="row">
	<div class="col-md-12">
	<h3>REGISTERED CHECKLISTS
	<button style="display:inline-block" class="pull-right btn btn-md btn-primary" onclick="createChecklist()">CREATE CHECKLIST <i class="fa fa-floppy-o"></i></button>
	</h3>
	<br>
	<table class="table table-bordered" width="100%">
		<thead>
			<tr class="bg-primary" >
				<th >NO.</th>
				<th >CHECKLIST NAME</th>
				<th>CHECKLIST DATA</th>
				<th>ACTION</th>
			</tr>
		</thead>
		<tbody id="data">
			
		</tbody>
	</table>
	</div>
</div>	
</body>
<script src="js/jquery-1.8.3.min.js"></script>

<script>

$(document).ready(function(){
	$.ajax({
		type:'post',
		url:'readChecklist.php',
	}).done(function(data){
		$("#data").html(data);
	})
})

function createChecklist(){
	localStorage.removeItem("cPointOptions");
	window.location.href = 'createChecklist.php'
}
</script>

