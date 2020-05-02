<?php 
	$id = $_GET["id"];
	$task = $viewmodel[1];
	$assigne_to = $viewmodel[3];

	foreach($assigne_to as $key => $value) :
		$assigne_to_js[$key]['label'] = $value['user_name'];
		$assigne_to_js[$key]['id'] = $value['user_id'];
	endforeach;
?> 
<div class="pt-10 p-5 row">
	<div class="col-md-8">
		<form method="post" action="<?php $_SERVER['PHP_SELF'];?>" class="ml-6">
			<input type="hidden" name="task_id" value="<?php echo $task['task_id'];?>" title="Click to edit"/>
			<input type="hidden" name="post_id" value="<?php echo $task['post_id'];?>"/>
			<input class="efi fs-30 change" type="text" name="task_title" value="<?php echo $task['task_title'];?>" title="Click to edit"/>
			<hr class="hr">
		
			<!------------------------[ dropdown Details ]-------------------------->
			<small><p id="details-button" class="dropdown-details">
			<span class="caret"></span>Details</p> </small>
			<div id="details" class="dropdown-content">
				<table>
					<tr>
						<td>Status</td>
						<td>
							<select class="change details" name="task_status" title="Click to edit">
								<option <?php if ($task['task_status'] == 0 ) echo 'selected';?> value="0">Open</option>
								<option <?php if ($task['task_status'] == 1 ) echo 'selected';?> value="1">In Progress</option>
								<option <?php if ($task['task_status'] == 2 ) echo 'selected';?> value="2">Done</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Type</td>
						<td class="pt-10px">
						<select class="change details" name="task_type" title="Click to edit">
							<option <?php if ($task['task_type'] == 1 ) echo 'selected';?> value="1">Development</option>
							<option <?php if ($task['task_type'] == 2 ) echo 'selected';?> value="2">Bug</option>
							<option <?php if ($task['task_type'] == 3 ) echo 'selected';?> value="3">Update</option>
							<option <?php if ($task['task_type'] == 4 ) echo 'selected';?> value="4">Idea</option>
							<option <?php if ($task['task_type'] == 5 ) echo 'selected';?> value="5">Unit Testing</option>
							<option <?php if ($task['task_type'] == 6 ) echo 'selected';?> value="6">Others</option>
						</select>
						</td>
					</tr>
					<tr>
						<td class="pt-10px pr-5">Priority</td>
						<td class="pt-10px">
						<select class="change details" name="task_priority" title="Click to edit">
							<option <?php if ($task['task_priority'] == 1 ) echo 'selected';?> value="1">Critical</option>
							<option <?php if ($task['task_priority'] == 2 ) echo 'selected';?> value="2">Highest</option>
							<option <?php if ($task['task_priority'] == 3 ) echo 'selected';?> value="3">High</option>
							<option <?php if ($task['task_priority'] == 4 ) echo 'selected';?> value="4">Medium</option>
							<option <?php if ($task['task_priority'] == 5 ) echo 'selected';?> value="5">Low</option>
							<option <?php if ($task['task_priority'] == 6 ) echo 'selected';?> value="6">Lowest</option>
							<option <?php if ($task['task_priority'] == 7 ) echo 'selected';?> value="7">Fature</option>
						</select>
						</td>
					</tr>
				</table>
			</div>
			<br/>
			<!------------------------[ dropdown Description ]---------------------->
			<small>
				<p id="description-button" class="dropdown-details">
					<span class="caret"></span>Description
				</p>
			</small>
			<div id="description" >
				<textarea id="task_body" class="efi text-break textarea-update change dropdown-content" name="task_body" title="Click to edit" ><?php echo $task['task_body']; ?></textarea>
				<br/><br/>
			</div>		
			<input id="btn-edit" class="btn btn-primary" type="submit" name="task_submit" value = "Edit" />
			<br/><br/>
			<!------------------------[ dropdown Comment ]---------------------->
			<small><p id="comments-button" class="dropdown-comments">
			<span class="caret"></span>Comments</p> </small>
			<div id="comments" >
				<br/>
				<?php foreach($viewmodel[2] as $comment) : ?>
					<div class="row">
						<div>
							<img src="<?php echo ROOT_PATH; ?>img/profile-images/<?php echo $comment['user_img'];?>" class="comment">
						</div>
						<div class="bubble_profile p-15">
							<div class="row">
								<div class="col-md-3">
									<h4><?php echo $comment['user_name'];?></h4>
								</div>
								<div class="col-md-3">
									<small><?php echo $comment['comment_create_date'];?></small>
								</div>
								<div class="col-md-3">
									<small><?php echo $comment['comment_create_time'];?></small>
								</div>
								<div class="col-md-3"></div>
							</div><br/>
							<div class="row">
								<div class="col-md-12">
									<div class="comment-title">
										<?php echo $comment['comment_body'];?>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach;?>
				<hr/>
				<!---Add new Comment--->
				<div class="row">
					<div>
						<img  class="comment" src="<?php echo ROOT_PATH; ?>img/profile-images/<?php echo $viewmodel[4];?>">
					</div>
					<div class="bubble_profile">
						<textarea class="add-comment-txt" name="comment_body"></textarea>
					</div>
				</div>
				<br/>

				<div class="row">
					<div class="col-md-12">
						<input class="btn btn-primary navbar-right" type="submit" name="comment_submit" value = "Send" />
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 dd-people">
			<!------------------------[ dropdown People ]---------------------->
			<small>
				<p id="people-button" class="dropdown-details">
					<span class="caret"></span>People
				</p>
			</small>
			<div id="people" class="dropdown-content">
				<table>
					<tr>
						<th class="pr-10 pb-10">
							<h3 class="float-l">Assignee</h3>
						</th>	
						<td class="pb-10">
							<input type="search" id="tags" class="dd-inputs" value="<?php echo $task['user_name'];?>">
							<input class="change dis-none" id="result" name="user_id" value="<?php echo $task['user_id'];?>">
						</td>	
					</tr>
					<tr>
						<th class="pr-10 pb-10">
							<h3 class="float-l">Reporter</h3>
						</th>	
						<td class="pb-10">
							<div class="dd-inputs"><?php echo $task['user_name_reporter'];?></div>
						</td>	
					</tr>
				</table>
			</div>
			<br/><br/>
			<!------------------------[ dropdown Dates ]---------------------->
			<small><p id="dates-button" class="dropdown-details">
			<span class="caret"></span>Dates</p></small>
			<div id="dates" class="dropdown-content">
				<table>
					<tr>
						<th class="pr-10 pb-10">
							<h3>Created</h3>
						</th>	
						<td class="pb-10">
							<div class="change dd-inputs"><?php echo $task['task_create_date']; ?></div>
						</td>	
					</tr>
					<tr>
						<th class="pr-10">
							<h3>Deadline</h3>
						</th>	
						<td>
							<input class="change dd-inputs" id="datepicker" type="text" name="task_deadline" value="<?php echo $task['task_deadline'];?>" autocomplete="off">
						</td>
					</tr>
				</table>
				<br/>

				<?php if ($task['task_status'] == 0 || $task['task_status'] == 1){?>						
					<div id="getting-started" class="justify-content-center"><div>	
				<?php }?>				
			</div>
		</div>
	</form>
</div>

<script src="<?php echo ROOT_PATH; ?>myscripts.js"></script>
<script>
	//dropdown Details
	$(document).ready(function(){
		$("#details-button").click(function(){
			$("#details").toggle();
		});
	});

	//dropdown Description
	$(document).ready(function(){
		$("#description-button").click(function(){
			$("#description").toggle();
		});
	});

	//dropdown Comments
	$(document).ready(function(){
		$("#comments-button").click(function(){
			$("#comments").toggle();
		});
	});

	//dropdown People
	$(document).ready(function(){
		$("#people-button").click(function(){
			$("#people").toggle();
		});
	});

	//dropdown Dates
	$(document).ready(function(){
		$("#dates-button").click(function(){
			$("#dates").toggle();
		});
	});

	//calendar
	$( function(){
		$( "#datepicker" ).datepicker();
	});

	//countdown
	$("#getting-started")
	.countdown("<?php echo $task['task_deadline']; ?>", function(event) {
		$(this).text(
		event.strftime('%D days %H:%M:%S')
		);
	});

	//click button
	$(".change").change(function() {
		$("#btn-edit").click(); 
	});

	// Search assigne to 
	var availableTags = <?php echo json_encode($assigne_to_js); ?>;
	
	$("#tags").autocomplete({
		source: availableTags,
		select: function(event, ui) {
			$("#result").val(ui.item.id);
		}
	});
</script>