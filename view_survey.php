<?php include 'db_connect.php' ?>
<?php 
$qry = $conn->query("SELECT * FROM survey_set where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	if($k == 'title') $k = 'stitle';
	$$k = $v;
}
$answers = $conn->query("SELECT distinct(user_id) from answers where survey_id ={$id}")->num_rows;
?>
<div class="col-lg-12">
	<div class="row">
		<div class="col-md-4">
			<div class="card card-outline card-primary">
				<div class="card-header">
					<h3 class="card-title">Судалгааны мэдээлэл</h3>
				</div>
				<div class="card-body p-0 py-2">
					<div class="container-fluid">
						<p>Гарчиг: <b><?=$stitle ?></b></p>
						<p class="mb-0">Тайлбар:</p>
						<small><?=$description; ?></small>
						<p>Эхлэх огноо: <b><?=date("Y-m-d",strtotime($start_date)) ?></b></p>
						<p>Дуусах огноо: <b><?=date("Y-m-d",strtotime($end_date)) ?></b></p>
						<p>Бөглөсөн хүний тоо: <b><?=number_format($answers) ?></b></p>

					</div>
					<hr class="border-primary">
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card card-outline card-success">
				<div class="card-header">
					<h3 class="card-title"><b>Санал асуулгын хуудас</b></h3>
					<div class="card-tools">
						<button class="btn btn-block btn-sm btn-default btn-flat border-success new_question" type="button"><i class="fa fa-plus"></i> Шинэ асуулт нэмэх</button>
					</div>
				</div>
				<form action="" id="manage-sort">
				<div class="card-body ui-sortable">
					<?php 
					$question = $conn->query("SELECT * FROM questions where survey_id = $id order by abs(order_by) asc,abs(id) asc");
					while($row=$question->fetch_assoc()):	
					?>
					<div class="callout callout-info">
						<div class="row">
							<div class="col-md-12">	
								<span class="dropleft float-right">
									<a class="fa fa-ellipsis-v text-dark" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
									<div class="dropdown-menu">
								        <a class="dropdown-item edit_question text-dark" href="javascript:void(0)" data-id="<?=$row['id']?>">Засах</a>
								        <div class="dropdown-divider"></div>
								        <a class="dropdown-item delete_question text-dark" href="javascript:void(0)" data-id="<?=$row['id']?>">Устгах</a>
								     </div>
								</span>	
							</div>	
						</div>	
						<h5><?=$row['question'] ?></h5>	
						<div class="col-md-12">
						<input type="hidden" name="qid[]" value="<?=$row['id'] ?>">	
							<?php
								if($row['type'] == 'radio_opt'): 
									foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="radio" id="option_<?=$k ?>" name="answer[<?=$row['id']?>]" value="<?=$k ?>" checked="">
		                        <label for="option_<?=$k?>"><?=$v?></label>
		                     </div>
								<?php endforeach; ?>
						<?php elseif($row['type'] == 'check_opt'): 
									foreach(json_decode($row['frm_option']) as $k => $v):
							?>
							<div class="icheck-primary">
		                        <input type="checkbox" id="option_<?=$k ?>" name="answer[<?=$row['id'] ?>][]" value="<?=$k ?>" >
		                        <label for="option_<?=$k ?>"><?=$v ?></label>
		                     </div>
								<?php endforeach; ?>
						<?php else: ?>
							<div class="form-group">
								<textarea name="answer[<?=$row['id'] ?>]" id="" cols="30" rows="4" class="form-control" placeholder="Энд ямар нэг зүйл бичээрэй ..."></textarea>
							</div>
						<?php endif; ?>
						</div>	
					</div>
					<?php endwhile; ?>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.ui-sortable').sortable({
			placeholder: "ui-state-highlight",
			 update: function( ) {
			 	alert_toast("Асуулт эрэмбэлэх дарааллыг хадгалж байна.","info")
		        $.ajax({
		        	url:"ajax.php?action=action_update_qsort",
		        	method:'POST',
		        	data:$('#manage-sort').serialize(),
		        	success:function(resp){
		        		if(resp == 1){
			 				alert_toast("Асуултын эрэмбийг амжилттай хадгаллаа.","success")
		        		}
		        	}
		        })
		    }
		})
	})
	$('.new_question').click(function(){
		uni_modal("Шинэ асуулт","manage_question.php?sid=<?=$id ?>","large")
	})
	$('.edit_question').click(function(){
		uni_modal("Шинэ асуулт","manage_question.php?sid=<?=$id?>&id="+$(this).attr('data-id'),"large")
	})
	
	$('.delete_question').click(function(){
	_conf("Та энэ асуултыг устгахдаа итгэлтэй байна уу?","delete_question",[$(this).attr('data-id')])
	})
	function delete_question($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_question',
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