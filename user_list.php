<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_user"><i class="fa fa-plus"></i> Шинэ хэрэглэгч нэмэх</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-bordered" id="list">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Нэр</th>
						<th>Холбоо барих</th>
						<th>Үүрэг</th>
						<th>Имэйл</th>
						<th>Оноо</th>
						<th>Үйлдэл</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$type = array('',"Admin","Staff","Subscriber");
					$qry = $conn->query("SELECT *,concat(lastname,', ',firstname,' ',middlename) as name FROM users order by concat(lastname,', ',firstname,' ',middlename) asc");
					while($row= $qry->fetch_assoc()):
					?>
					<tr>
						<th class="text-center"><?=$i++ ?></th>
						<td><b><?=ucwords($row['name']) ?></b></td>
						<td><b><?=$row['contact'] ?></b></td>
						<td><b><?=$type[$row['type']] ?></b></td>
						<td><b><?=$row['email'] ?></b></td>
						<td><span class="nav-link"><i class="fas fa-coins text-warning"></i> <?=$row['total_point']?></span></td>
						<td class="text-center">
							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
							Үйлдэл
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_user" href="javascript:void(0)" data-id="<?=$row['id'] ?>">Харах</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item" href="./index.php?page=edit_user&id=<?=$row['id'] ?>">Засах</a>
		                      <div class="dropdown-divider"></div>
		                      <a class="dropdown-item delete_user" href="javascript:void(0)" data-id="<?=$row['id'] ?>">Устгах</a>
		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#list').dataTable()
	$('.view_user').click(function(){
		uni_modal("<i class='fa fa-id-card'></i> Хэрэглэгчийн мэдээлэл","view_user.php?id="+$(this).attr('data-id'))
	})
	$('.delete_user').click(function(){
	_conf("Та энэ хэрэглэгчийг устгахдаа итгэлтэй байна уу?","delete_user",[$(this).attr('data-id')])
	})
	})
	function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Өгөгдлийг амжилттай устгалаа",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>