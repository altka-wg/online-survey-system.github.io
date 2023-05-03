<? if(!isset($conn)) include 'db_connect.php' ;?>
<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="" id="manage_survey">
				<input type="hidden" name="id" value="<?=isset($id) ? $id : '' ?>">
				<div class="row">
					<div class="col-md-6 border-right">
						<div class="form-group">
							<label for="" class="control-label">Гарчиг</label>
							<input type="text" name="title" class="form-control form-control-sm" required value="<?=isset($stitle) ? $stitle : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Эхлэх огноо</label>
							<input type="date" name="start_date" class="form-control form-control-sm" required value="<?=isset($start_date) ? $start_date : '' ?>">
						</div>
						<div class="form-group">
							<label for="" class="control-label">Дуусах огноо</label>
							<input type="date" name="end_date" class="form-control form-control-sm" required value="<?=isset($end_date) ? $end_date : '' ?>">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label">Тайлбар</label>
							<textarea name="description" id="" cols="30" rows="4" class="form-control" required><?=isset($description) ? $description : '' ?></textarea>
						</div>
						<div class="form-group">
							<label for="" class="control-label">Оноо</label>
							<input type="text" name="point" class="form-control form-control-sm" required value="<?=isset($point) ? $point : ''?>">
						</div>
					</div>
				</div>
				<hr>
				<div class="col-lg-12 text-right justify-content-center d-flex">
					<button class="btn btn-primary mr-2">Хадгалах</button>
					<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=survey_list'">Цуцлах</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('#manage_survey').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_survey',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Өгөгдлийг амжилттай хадгаллаа.',"success");
					setTimeout(function(){
						location.replace('index.php?page=survey_list')
					},1500)
				}
			}
		})
	})
</script>