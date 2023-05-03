<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v) $meta[$k] = $v;
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	<form action="" id="manage-user">	
		<input type="hidden" name="id" value="<?=isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Овог</label>
			<input type="text" name="lastname" id="lastname" class="form-control" value="<?=isset($meta['lastname']) ? $meta['lastname']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="name">Нэр</label>
			<input type="text" name="firstname" id="firstname" class="form-control" value="<?=isset($meta['firstname']) ? $meta['firstname']: '' ?>" required>
		</div>
		<!-- <div class="form-group">
			<label for="name">Дунд нэр</label>
			<input type="text" name="middlename" id="middlename" class="form-control" value="<=isset($meta['middlename']) ? $meta['middlename']: '' ?>">
		</div> -->
		
		<div class="form-group">
			<label for="username">Имэйл</label>
			<input type="text" name="email" id="email" class="form-control" value="<?=isset($meta['email']) ? $meta['email']: '' ?>" required  autocomplete="off">
		</div>
		<div class="form-group">
			<label for="password">Нууц үг</label>
			<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
			<small><i>Хэрэв та нууц үгээ солихыг хүсэхгүй байгаа бол хоосон орхино уу.</i></small>
		</div>
	</form>
</div>
<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=update_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Өгөгдлийг амжилттай хадгаллаа",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Хэрэглэгчийн нэр аль хэдийн байна</div>')
					end_load()
				}
			}
		})
	})

</script>