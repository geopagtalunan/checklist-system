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
<style>
table {
  border-collapse: collapse;
  width:100%
}
th, td {
  border: 1px solid black;
  padding:10px
}
</style>
<body style="width:100%;padding:20px" >
<h2 style="font-weight:bold">NAME OF CHECKLIST:</h2>
<input style="display:inline-block;width:200px"  type="text" id="checklist" class="form-control">
<button style="display:inline-block" class="btn btn-md btn-primary" onclick="saveChecklist()">SAVE CHECKLIST <i class="fa fa-floppy-o"></i></button>



<div class="row">
	<div class="col-md-3">
	<h3>CHECKPOINTS</h3>
	<table class="table table-bordered" id="partsTable" width="100%">
		<thead>
			<tr class="bg-primary" >
				<th colspan=2>CHECKCODE</th>
				<th>CHECKPOINT</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan=2><input type='text' id="cPointCode" name="parts[]" placeholder="checkcode" style="width:100%"  class='form-control' > </td>
				<td><input type='text' id="cPointCheck" placeholder="checkpoint" style="width:100%"  class='form-control' ></td>
			</tr>
			<tr>
				<td colspan=3><button style="float:right" id="cPoint">ADD</button></td>
			</tr>
		</tbody>
		
	</table>
	</div>

	<div class="col-md-3">
	<h3>CHECKITEMS</h3>
	<table class="table table-bordered" id="partsTables" width="100%">
		<thead>
			<tr class="bg-primary" >
				<th colspan=2>CHECKPOINT</th>
				<th>CHECKITEM</th>
			</tr>	
		</thead>
		<tbody>
			<tr>
				<td colspan=2><select type='text' id="checkcode" placeholder="checkcode" style="width:100%" class='form-control' ><option selected hidden></option></select> </td>
				<td><input type='text' id="itemValue" placeholder="CHECKITEM" style="width:100%"  class='form-control' ></td>
			</tr>
			<tr>
				<td colspan=3><button style="float:right" id="item">ADD</button></td>

			</tr>
		</tbody>
		
	</table>
	</div>
	<div class="col-md-6">
	<h3>SUB CHECKITEM</h3>
	<table class="table table-bordered" id="partsTables" width="100%">
		<thead>
			<tr class="bg-primary" >
				<th colspan=2>CHECKITEM</th>
				<th>SUB CHECKITEM</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan=2><select type='text' id="checkitem" placeholder="CHECKITEM" style="width:100%" class='form-control' ></select> </td>
				<td><input type='text' id="subItemValue" placeholder="SUB CHECKITEM" style="width:100%"  class='form-control' ></td>
			</tr>
			<tr>
				<td colspan=3><button style="float:right" id="subItem">ADD</button></td>

			</tr>
		</tbody>
		
	</table>
	</div>


	<div class="col-md-12" id="table">
		
	</div>
</div>	
</body>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/index.js"></script>
<script>
window.onbeforeunload = function() {
	return "Dude, are you sure you want to refresh? Think of the kittens!";
}
function saveChecklist(){
	let nameChecklist = $("#checklist").val();
	let data = localStorage.getItem("cPointOptions");
	let checklist = "";
	if (typeof data !== 'undefined' && data !== null){
		checklist = data;
	}
	if(checklist.length > 0){
	$.ajax({
		type:'post',
		url:'checkExist.php',
		data:{
			"nameChecklist" : nameChecklist,
			"checkItems" : checklist
		}
	}).done(function(data){
		console.log(data)
	})
	}else{
		alert("Encode data first before saving record!")
		// console.log(alert)
	}
	// console.log(nameChecklist,data);
}


</script>

