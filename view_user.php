<?php include 'db_connect.php';
if(isset($_GET['id'])){
	$type_arr = array('',"Admin","Staff","Subscriber");
	$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
}
?>
<div class="container-fluid">
	<table class="table">
		<tr>
			<th>Нэр:</th>
			<td><b><?=ucwords($name) ?></b></td>
		</tr>
		<tr>
			<th>Имэйл:</th>
			<td><b><?=$email ?></b></td>
		</tr>
		<tr>
			<th>Холбоо барих:</th>
			<td><b><?=$contact ?></b></td>
		</tr>
		<tr>
			<th>Хаяг:</th>
			<td><b><?=$address ?></b></td>
		</tr>
		<tr>
			<th>Хэрэглэгчийн үүрэг:</th>
			<td><b><?=$type_arr[$type] ?></b></td>
		</tr>
	</table>
</div>
<div class="modal-footer display p-0 m-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
</div>
<style>
	#uni_modal .modal-footer{
		display: none
	}
	#uni_modal .modal-footer.display{
		display: flex
	}
</style>