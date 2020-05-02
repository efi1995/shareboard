<div class="container p-5" style='margin-top:80px;'>
	<div class="well" style='background-color:white;border: 1px solid #77092eec;border-radius:15px'>
		<div class="container panel-heading text-center" style="background-color:white;margin-top:-6%;margin-left:21%;height:9%;width:58%;border: 1px solid #e3e3e3;border-radius: 50px;">
			<h3 class="panel-title" style='padding-top:15px;'><strong>Add new Wiki!</strong></h3>
		</div>
		<div class="panel-body">
			<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
				<div class="form-group">
					<label>Title</label>
					<input type="text" name="wiki_title" class="form-control" />
				</div>
				<div class="form-group">
					<label>Body</label>
					<textarea name="wiki_body" class="form-control h-400" style='border-radius:0px 65px 0px 65px;'></textarea>
				</div>
				<input class="btn btn-primary" name="wiki_submit" type="submit" value="Add wiki" />
				<a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>wiki">Cancel</a>
			</form>
		</div>
	</div>
</div>