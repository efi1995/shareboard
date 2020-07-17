<?php $id = $_GET["id"];?>

<div class="container pt-5" id="post-update">
	<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		<div class="row title">
			<div class="fs-30 title-content" title="Click to edit">
				<?php echo $viewmodel[1]['post_title']; ?>
			</div>
			<a class="fs-100 title-btn" href="<?php echo ROOT_PATH; ?>tasks/add/<?php echo $id;?>" title="Add new task" ><span class="glyphicon glyphicon-plus"></span></a>
		</div>
	</form>
	
	<!-- Tasks -->
	<div class="row post-update-container">
		<div class="text-center post-update-child" id="status-open">
			<div class="row" style="padding:2%">
				<div class="col-md-12 title-container">
					<h4>Open</h4>
				</div>
				<div class="status-selector-container">
					<div class="col-md-12 select-status">
						<select class="status-selector" name="task_status" title="Click to edit">
							<option value="status" selected disabled>Select Category</option>
							<option value="status-open">Open</option>
							<option value="status-inprogress">In Progress</option>
							<option value="status-done">Done</option>
						</select>
					</div>
				</div>
			</div>
			<?php foreach($viewmodel[2] as $task) : ?>
				<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<div style="border-radius:5px;background-color:white;padding-left:1%;">
						<div class="row">
							<div class="col-md-12">
								<a name="task_edit" href="<?php echo ROOT_PATH; ?>tasks/update/<?php echo $task['task_id'];?>">
									<h4 class="task-title"><?php echo $task['task_title'];?></h4>
								</a>					
							</div>
						</div><br/>
						<div class="row">
							<div class="col-md-6">
								<input id="datepicker<?php echo $task['task_id'];?>" style="margin:1%;padding-bottom:2%;border:1px black solid;border-radius:5px;" type="text" name="task_deadline" value="<?php echo $task['task_deadline'];?>">
							</div>
							<div class="col-md-6">
								<input type="hidden" name="open_push" value="<?php echo $task['task_id'];?>">
								<input id="open_push_submit<?php echo $task['task_id'];?>" name="open_push_submit" type="submit" value="->" class="btn btn-default" disabled>
								
							</div>
						</div>
					</div>
					<script>
					//calendar
					$(function(){
						$("#datepicker<?php echo $task['task_id'];?>").datepicker();
					});
					$("#datepicker<?php echo $task['task_id'];?>").change(function() {
						$('#open_push_submit<?php echo $task['task_id'];?>').removeAttr('disabled');
					});
					</script>
				</form>
			<?php endforeach;?>
		</div>
		<div class="post-update-child" id="status-inprogress">
			<div class="row" style="padding:2%">
				<div class="col-md-12" style="flex: 1;text-align: right;">
					<h4>In Progress</h4>
				</div>
				<div class="" style="flex: 1;justify-content: flex-end;display: flex;">
					<div class="col-md-12 select-status">
						<select class="status-selector" name="task_status" style="border:1px black solid;border-radius:5px;width:100px;" title="Click to edit">
							<option value="status" selected disabled>Select Category</option>
							<option value="status-open">Open</option>
							<option value="status-inprogress">In Progress</option>
							<option value="status-done">Done</option>
						</select>
					</div>
				</div>
			</div>
			<?php foreach($viewmodel[3] as $task) : ?>
				<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<div style="border-radius:5px;background-color:white;padding-left:2%;padding-bottom:2.5%;padding-right:2%;">
						<div class="row">
							<div class="col-md-8 text-left">
								<a name="task_edit" href="<?php echo ROOT_PATH; ?>tasks/update/<?php echo $task['task_id']; ?>">
									<h4 class="task-title"><?php echo $task['task_title'];?></h4>
								</a>
							</div>
							<div class="col-md-4 text-right">
								<input type="hidden" name="in_progress_push" value="<?php echo $task['task_id'];?>">
								<input class="text-right" name="in_progress_push_submit" type="submit" value="->" class="btn btn-default">
							</div>
						</div>
						<br/>
						<div class="row">
							<div class="col-md-6">
								<?php echo $task['user_name'];?>
							</div>
							<div class="col-md-6 text-right">
								<?php echo $task['task_deadline'];?>
							</div>
						</div>
					</div>
				</form>
			<?php endforeach;?>
		</div>
		<div class="post-update-child" id="status-done">
			<div class="row" style="padding:2%">
				<div class="col-md-12" style="flex: 1;text-align: right;">
					<h4>Done</h4>
				</div>
				<div class="" style="flex: 1;justify-content: flex-end;display: flex;">
					<div class="col-md-12 select-status">
						<select class="status-selector" name="task_status" style="border:1px black solid;border-radius:5px;width:100px;" title="Click to edit">
							<option value="status" selected disabled>Select Category</option>
							<option value="status-open">Open</option>
							<option value="status-inprogress">In Progress</option>
							<option value="status-done">Done</option>
						</select>
					</div>
				</div>
			</div>
			<?php foreach($viewmodel[4] as $task) : ?>
				<div class="row" style="margin:1%;border-radius:5px;background-color:white;padding:1%;">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 text-left">
								<a name="task_edit" href="<?php echo ROOT_PATH; ?>tasks/update/<?php echo $task['task_id']; ?>">
									<h4 class="task-title"><?php echo $task['task_title'];?></h4>
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-11 text-right">
							<?php echo $task['task_deadline'];?>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1 text-left">

							</div>
							<div class="col-md-10 text-left">
								<?php echo $task['user_name'];?>
							</div>
						</div>
					</div>					
				</div>
			<?php endforeach;?>
		</div>
	</div>	
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

<script>
	var $window = $(window);

	if ($window.width() < 992) {
		$("#post-update").removeClass("container");
		$("#post-update").addClass("flexefi");
	}
	
	$(function() {    
		$('.status-selector').change(function(){
			$('.post-update-child').css('display','none');
			$('#' + $(this).val()).css('display','block');
			$(this).val('status');
		});
	});
</script>