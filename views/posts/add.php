<div class="container p-5 pt-10">
<div class="well">
  <div class="container panel-heading text-center">
    <h3 class="panel-title"><strong>Add new Post!</strong></h3>
  </div>

  <div class="panel-body">
    <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
    	<div class="form-group">
    		<label>Title</label>
    		<input type="text" name="post_title" class="form-control" />
		</div>
		
    	<div class="form-group">
    		<label>Body</label>
    		<textarea name="post_body" class="form-control h-400"></textarea>
		</div>
		
		<div class="form-group">
			<a  href="<?php echo ROOT_PATH; ?>img">Select image</a>
		</div>
		
    	<input class="btn btn-primary" name="post_submit" type="submit" value="Add Post" />
        <a class="btn btn-danger" href="<?php echo ROOT_PATH; ?>posts">Cancel</a>
    </form>
  </div>
</div>