<?php include 'db_connect.php';
$answers = $conn->query("SELECT distinct(survey_id) from answers where user_id ={$_SESSION['login_id']}");
$ans = array();
while($row=$answers->fetch_assoc()){$ans[$row['survey_id']] = 1;}
?>
<div class="col-lg-12">
	<div class="d-flex w-100 justify-content-center align-items-center mb-2">
		<label for="" class="control-label">Судалгаа</label>
		<div class="input-group input-group-sm col-sm-5">
          <input type="text" class="form-control" id="filter" placeholder="Хайх үг оруулна уу...">
          <span class="input-group-append">
            <button type="button" class="btn btn-primary btn-flat" id="search">Хайх</button>
          </span>
        </div>
	</div>
	<div class=" w-100" id='ns' style="display: none"><center><b>Үр дүн байхгүй.</b></center></div>
	<div class="row">
		<?php 
		$survey = $conn->query("SELECT * FROM survey_set where '".date('Y-m-d')."' between date(start_date) and date(end_date) order by date_created desc ");
		while($row=$survey->fetch_assoc()):
		?>
		<div class="col-md-3 py-1 px-1 survey-item">
			<div class="card card-outline card-primary">
              <div class="card-header d-flex align-items-center">
                <h3 class="card-title text-truncate"><?=ucwords($row['title']) ?></h3>

                <div class="card-tools w-100 text-right">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body text-truncate" style="display: block;">
               <?=$row['description'] ?>
               <div class="row">
               	<hr class="border-primary">
               	<div class="d-flex justify-content-center w-100 text-center">
               		<?php if(!isset($ans[$row['id']])): ?>
               			<a href="index.php?page=answer_survey&id=<?=$row['id'] ?>" class="btn btn-sm bg-gradient-primary mt-2"><i class="fa fa-pen-square"></i> Судалгаанд хамрагдах</a>
               		<?php else: ?>
               			<p class="text-primary border-top border-primary">Бөглөсөн</p>
               		<?php endif; ?>
               	</div>
               </div>
              </div>
            </div>
		</div>
	<?php endwhile; ?>
	</div>
</div>
<script>
	function find_survey(){
		start_load()
		var filter = $('#filter').val()
			filter = filter.toLowerCase()
			console.log(filter)
		$('.survey-item').each(function(){
			var txt = $(this).text()
			if((txt.toLowerCase()).includes(filter) == true){
				$(this).toggle(true)
			}else{
				$(this).toggle(false)
			}
			if($('.survey-item:visible').length <= 0){
				$('#ns').show()
			}else{
				$('#ns').hide()
			}
		})
		end_load()
	}
	$('#search').click(function(){
		find_survey()
	})
	$('#filter').keypress(function(e){
		if(e.which == 13){
		find_survey()
		return false;
		}
	})
</script>