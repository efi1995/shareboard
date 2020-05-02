<div class="container p-5">
	<?php $id = $_GET["id"];?>
	<br/>
	<h2 class="text-center tasks-index-title">Tasks</h2>
	<br/><br/><br/><br/><br/>
	<div>
		<?php foreach($viewmodel[1] as $open_tasks) :?>
			<div class="">
				<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<input type="hidden" name="Task_edit_id" value="<?php echo $open_tasks['task_id'];?>"/>
					<a name="task_edit" href="<?php echo ROOT_PATH; ?>tasks/update/<?php echo $open_tasks['task_id'];?>">
					<h4 class="task-title"><?php echo $open_tasks['task_title']; ?></h4></a><br/>
					<input type="hidden" name="task_delete_id" value="<?php echo $open_tasks['task_id'];?>">
					<input class="btn btn-clear task-button" type="submit" name="task_delete" value="X" title="Delete task"/><br>
					<hr>
				</form>
			</div>
		<?php endforeach;?>		
	</div>
</div>