<?php 

include('connection.php');

try{
$pdo = new PDO(DSN,DB_USR,DB_PWD);
$pdo->setAttribute(PDO::ATTR_ERRMODE ,PDO::ERRMODE_EXCEPTION);
$stmt = $pdo->prepare("SELECT * from checkitems");
$stmt->execute();
$data = "";
$i = 1;
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
	$data .= '<tr>'; 
	$data .= '<td>'.$i.'</td>'; 
	$data .= '<td>'.$row["checklistName"].'</td>'; 
	$data .= '<td>'.$row["checkitems"].'</td>'; 
	$data .= '<td><button class="btn btn-success">VIEW<i class="fa fa-eye"></button></td>'; 
	$data .= '</tr>'; 
	$i++;
}

echo $data;

}catch(PDOExecption $e){
	echo $e->getMessage();
}
$pdo=null
?>