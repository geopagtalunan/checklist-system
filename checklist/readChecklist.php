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
	$data .= '<td><button class="btn btn-success" id="view" rel="'.$row["checklistName"].'" name="'.$row["checkitems"].'" >VIEW<i class="fa fa-eye"></button></td>'; 
	$data .= '</tr>'; 
	$i++;
}

echo $data;

}catch(PDOExecption $e){
	echo $e->getMessage();
}
$pdo=null
?>

<script>
$(document).on('click','#view',function(){
	let data = {};
	let nameChecklist = $(this).attr("rel");
	let checkItems = $(this).parent().prev().text();
	data["nameChecklist"] = nameChecklist;
	data["checkItems"] = checkItems;
	console.log(data)
	localStorage.setItem("checklist",JSON.stringify(data));
	window.location.href= 'viewChecklist.php?name='+nameChecklist
})
</script>