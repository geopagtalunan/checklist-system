<?php

include('connection.php');
$checklist = $_GET["name"];
try{
$pdo = new PDO(DSN,DB_USR,DB_PWD);
$pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT * from checkitems where checklistName = '$checklist'");
$stmt->execute();
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$data = $row["checkitems"];
}
// echo $data;
$dataNew = json_decode($data,true);
$div = "";

	
	$div .= '<thead>';
	$div .= '<tr>';
	$div .= '<th style="text-align:center;font-size:20px">CODE</th>';
	$div .= '<th style="text-align:center;font-size:20px">CHECKPOINT</th>';
	$div .= '<th style="text-align:center;font-size:20px">&#10004;</th>';
	$div .= '<th style="text-align:center;font-size:20px">&#10008;</th>';
	$div .= '</tr>';
	foreach($dataNew as $key=>$val){
	$div .= '<tr>';
		$div .= '<th style="width:5%;text-align:center;font-size:bold;font-size:20px">'.$val["checkCode"].'</th>';
		$div .= '<th style="width:85%;text-align:left;font-size:bold;font-size:20px">'.$val["checkPoint"].'</th>';
		$div .= '<th style="width:5%;align:left;"><input style="float:center;" type="checkbox" class="checkss input-sm"></th>';
		$div .= '<th style="width:5%;align:left;"><input style="float:center;" type="checkbox" class="input-sm"></th>';
	foreach($val["checkItems"] as $a=>$b){
		// if(is_array($b)){
			// foreach($b as $c=>$d){
				$div .= '<tr>';
				$div .= '<th style="width:5%;text-align:center"></th>';
				$div .= '<th style="width:85%!important;font-size:16px">'.$val["checkCode"].''.$a.'. '.$b.'</th>';
				$div .= '<th style="width:5%;align:left;vertical-align:middle"><input style="float:center" type="checkbox" class="checkss input-sm"></th>';
				$div .= '<th style="width:5%;align:left;vertical-align:middle"><input style="float:center" type="checkbox" class="input-sm"></th>';
				if(isset($val["subCheckItem"])){
					$div .= '<tr>';
					if(isset($val["subCheckItem"][0][$val["checkCode"].''.$a])){
						$div .= '<th style="width:5%;text-align:center"></th>';
						$div .= '<th  style="width:85%!important;font-size:16px;">';
						foreach($val["subCheckItem"][0][$val["checkCode"].''.$a] as $d){
						$div .= '<label style="display:inline-block;margin-right:25px">'.$d.'<input style="display:inline-block" type="checkbox" ></label>';
						}
						$div .= '<th style="width:5%;text-align:center"></th>';
						$div .= '<th style="width:5%;text-align:center"></th>';
						$div .= '</th>';
					}
					$div .= '</tr>';
				}
				// $div .= '<th style="width:10%;align:left;"><input style="float:center;" type="checkbox" class="input-sm"></th>';
				
				$div .= '</tr>';
			}
		// }
		// foreach($b as $c=>$d){
			
		// }
	
	$div .= '</tr>';
	}
	$div .= '</thead>';
	
	

// echo $div;

}catch(PDOExecption $e){
	echo $e->getMessage();
}
$pdo=null
?>

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
.newspaper {
  column-count: 4;
  column-gap: 40px;
  column-rule: 1px solid black;
  font-size: 20px;

  
  
}

input[type=checkbox] {
  -webkit-appearance: none;
  -moz-appearance: none;
}

input[type=checkbox]::-ms-check {
  display: none;
}

input[type=checkbox] {
  position: relative;
  width: 30px;
  height: 30px;
  border: 1px solid gray;
  /* Adjusts the position of the checkboxes on the text baseline */ 
  vertical-align: 0px;
  left: 25%;
  right: 25%;
  /* Set here so that Windows' High-Contrast Mode can override */
  color: black;
}

input[type=checkbox]::before {
  content: '\2713';
  position: relative;
  left: 20%;
  right: 20%;
  font-size: 20px;
  text-align:center;
  visibility: hidden;
  
}

.checkss{
	content: '\2713';
}

input[type=checkbox]:checked::before {
  /* Use `visibility` instead of `display` to avoid recalculating layout */
  visibility: visible;
}


</style>

<body style="padding:50px">
<div class="row" style="width:100%;height:100%;border:2px solid black;">
	<div style="font-size:30px;text-align:center;font-weight:bold;border-bottom:2px solid black;padding:10px" id="title">
	<?php echo $checklist?> CHECKLIST
	</div>
	<br>
	<div class="col-md-12" style="font-size:20px;">
		<label>CONTROL NUMBER: </label>
		<input style="display:inline-block;width:200px;margin-right:10px" type="text" >
		<label>INCHARGE: </label>                    
		<input style="display:inline-block;width:200px;margin-right:10px" type="text" >
		<label>DATE: </label>                        
		<input style="display:inline-block;width:200px;margin-right:10px" type="text" >
	</div>
	<br>
	<br>
	<br>
	
	<div class="col-md-12 " style="border:1px solid black;padding:20px" id="contents">
		<table class="table table-bordered">
			<?php echo $div?>
		</table>
	</div>
	
</div>
</body>
<script src="js/jquery-1.8.3.min.js"></script>
<script type='text/javascript'>
window.onbeforeunload = function() {
	return "Dude, are you sure you want to refresh? Think of the kittens!";
}
</script>