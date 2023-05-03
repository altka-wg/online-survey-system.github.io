<?php include 'db_connect.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title') $k = 'stitle';
	$$k = $v;
}
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header"><h3 class="card-title"><b>Судалгааны мэдээлэл</b></h3></div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Гарчиг: <b><?=$stitle ?></b></p>
						<p class="mb-0">Тайлбар:</p>
						<small><?=$description; ?></small>
						<p>Эхлэх огноо: <b><?=date("Y-m-d",strtotime($start_date))?></b></p>
						<p>Дуусах огноо: <b><?=date("Y-m-d",strtotime($end_date))?></b></p>
						<p>Авах оноо: <b><?=number_format($point)?></b></p>
					</div>
					<hr class="border-primary">
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Санал асуулгын хуудас</b></h3>
				</div>
				<form action="" id="manage-survey">
					<input type="hidden" name="survey_id" value="<?=$id ?>">
					<input type="hidden" name="uid" value="<?=$_SESSION['login_id']?>">
					<input type="hidden" name="point" value="<?=$point?>">
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM questions where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<h5><?=$row['question'] ?></h5>	
						<div class="col-md-12">
						<input type="hidden" name="qid[<?=$row['id'] ?>]" value="<?=$row['id'] ?>">	
						<input type="hidden" name="type[<?=$row['id'] ?>]" value="<?=$row['type'] ?>">	
							<?php if($row['type'] == 'radio_opt'): foreach(json_decode($row['frm_option']) as $k => $v):?>
							<div class="icheck-primary">
		                        <input type="radio" id="option_<?=$k ?>" name="answer[<?=$row['id'] ?>]" value="<?=$k ?>">
		                        <label for="option_<?=$k ?>"><?=$v ?></label>
		                     </div>
								<?php endforeach; ?>
						<?php elseif($row['type'] == 'check_opt'): foreach(json_decode($row['frm_option']) as $k => $v):?>
							<div class="icheck-primary">
		                        <input type="checkbox" id="option_<?=$k ?>" name="answer[<?=$row['id'] ?>][]" value="<?=$k ?>" >
		                        <label for="option_<?=$k ?>"><?=$v ?></label>
		                     </div>
								<?php endforeach; ?>
						<?php else: ?>
							<div class="form-group">
								<textarea name="answer[<?=$row['id'] ?>]" id="" cols="30" rows="4" class="form-control" placeholder="Энд ямар нэг зүйл бичээрэй ..." ></textarea>
							</div>
						<?php endif; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				</form>
				<div class="card-footer border-top border-success">
					<div class="d-flex w-100 justify-content-center">
						<button class="btn btn-sm btn-flat bg-gradient-primary mx-1" form="manage-survey">Хариулт илгээх</button>
						<button class="btn btn-sm btn-flat bg-gradient-secondary mx-1" type="button" onclick="location.href = 'index.php?page=survey_widget'">Цуцлах</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('#manage-survey').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_answer',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp == 1){
					alert_toast("Баярлалаа.",'success')
					setTimeout(function(){
						location.href = 'index.php?page=survey_widget'
					},2000)
				}
			}
		})
	})
</script>