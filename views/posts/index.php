<div class="container text-center p-5">
	<?php
		if(isset($_SESSION['is_logged_in'])) : ?>
		<a class="navbar-right fs-100" href="<?php echo ROOT_PATH; ?>posts/add"><span class="glyphicon glyphicon-plus"></span></a>
		
	<?php endif; ?>
	
	<h1 class="text-center fs-43">Posts</h1>
	<hr class="divider2">
	<br/><br/><br/><br/>

	<?php foreach($viewmodel[1] as $item) : ?>
		<div class="card cards">

			<div id="portfolio">
				<div class="container-fluid p-0">

					<div class="row no-gutters portfolio-box">
						<img class="img-fluid2" src="img/1.jpg">
						<div class="portfolio-box-caption project-category text-white-50 img-fluid2">
							<?php echo $item['post_body']; ?>
						</div><!---portfolio-box-caption project-category text-white-50--->
					</div><!---row no-gutters portfolio-box--->

					<div class="">
						<input type="hidden" name="post_edit_id" value="<?php echo $item['post_id'];?>">
						<br/>
						
						<small><?php echo $item['post_create_date']; ?></small><br/><br/>

						<a class="edit" name="post_edit" href="<?php echo ROOT_PATH; ?>posts/update/<?php echo $item['post_id']; ?>"><h3><?php echo $item['post_title']; ?></h3></a><br>
						
						<?php if(isset($_SESSION['is_logged_in'])) : ?>
							<form  method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
								<input type="hidden" name="post_delete_id" value="<?php echo $item['post_id']; ?>">
								<input class="btn btn-danger" type="submit" name="post_delete" value="Delete" />
							</form>
						<?php endif; ?>
					</div><!------>
				</div><!---container-fluid p-0--->
			</div><!---portfolio--->
		</div><!---card--->
	<?php endforeach;?>
</div><!---container--->
 