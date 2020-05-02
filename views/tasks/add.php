<?php $id = $_GET["id"];?>

<div class="container p-5 pt-10">
	<div class="well">
		<div class="container panel-heading text-center">
			<h3 class="panel-title"><strong>Add new Task!</strong></h3>
		</div>
		<div class="panel-body">
			<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">

				<div class="form-group">
					<label>Title</label>
					<input type="text" name="task_title" class="form-control" />
					
				</div>

				<div class="form-group">
					<label>Body</label>
					<textarea name="task_body" class="form-control h-400"></textarea>
				</div>

				<div>
					<label>Assigne to</label>						
					<select class="form-control" name="user_id">
						<?php foreach($viewmodel[1] as $user) : ?>
							<option value="<?php echo $user['user_id'];?>">
								<?php echo $user['user_name'];?>
							</option>
						<?php endforeach; ?>
					</select>
					<br/>

					<input type="hidden" name="user_id_reporter" value= "<?php echo $_SESSION['user_data']['user_id'];?>">
				</div>

				<input class="btn btn-primary" name="task_submit" type="submit" value="Add Task"/>
			
				<a class="btn btn-danger" type="submit" href="<?php echo ROOT_PATH;?>tasks/<?php echo $id;?>">Cancel</a>
			</form>
		</div>
	</div>
</div>