<?php 

include('connection.php');
$val= $_REQUEST["nameChecklist"];
$data = $_REQUEST["checkItems"];
try{
$pdo = new PDO(DSN,DB_USR,DB_PWD);
$pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT checklistName from checkitems where checklistName =  '$val'");
$stmt->execute();
$count = $stmt->rowCount();
$sql = "INSERT INTO checkitems (checklistName, checkitems) values ('$val','$data')";
$upd = "UPDATE checkitems SET checkitems= '$data' where checklistName='$val'";
if($count == 0){
	$stmt1=$pdo->prepare($sql);
	$stmt1->execute();
}else{
	$stmt1=$pdo->prepare($upd);
	$stmt1->execute();
	
}
}catch(PDOExecption $e){
	echo $e->getMessage();
}
$pdo=null
?>