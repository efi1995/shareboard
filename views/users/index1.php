<?php
	$item = new UserModel();
	$item = $item->Index();
	$id = $_GET["id"];
?>
<form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" style="margin-left: 6px;">
	<div class="container bootstrap snippet" style="margin-top:100px;">

		<div class="row">
			</div>

		<div class="row">
		<div class="col-sm-1">
		</div>
			<div class="col-sm-4">
				<input type="hidden" name="user_id" value="<?php echo $item[1]['user_id']; ?>">
			<div class="col-sm-10"><h2><input type="text" name="user_name" value ="<?php echo $item[1]['user_name'];?>"/></h2></div>
		
				<div class="text-center">
					<img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" name="user_img" class="avatar img-circle img-thumbnail" alt="avatar">
					<input type="file" class="text-center center-block file-upload" >
				</div>

				</hr><br>		
				
				<ul class="list-group">
					<li class="list-group-item text-muted">Activity</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span>37</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Tasks</strong></span>78</li>
				</ul> 
				
				<div class="panel panel-default">
					<div class="panel-heading">Social Media</div>
					<div class="panel-body">
						<i class="fa fa-facebook fa-2x" style="margin-left:15px;"></i> <i class="fa fa-github fa-2x" style="margin-left:15px;"></i> 
						<i class="fa fa-twitter fa-2x" style="margin-left:15px;"></i> <i class="fa fa-pinterest fa-2x" style="margin-left:15px;"></i> 
						<i class="fa fa-google-plus fa-2x" style="margin-left:15px;"></i>
					</div>
				</div>

			</div>
			<div class="col-sm-1">
		</div>
			<div class="col-sm-6">
				<div class="tab-content">
					<div class="tab-pane active" id="home" style="margin-top:50px;">
						<hr>
						
						<div class="form-group" >
							<div class="col-xs-6">
								<label for="first_name"><h4>First name</h4></label>
								<input type="text" class="form-control" name="user_first_name" value ="<?php echo $item[1]['user_first_name']; ?>" placeholder="First Name" title="Enter your first name."/>
								<br>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="last_name"><h4>Last name</h4></label>
								<input type="text" class="form-control" name="user_last_name" value ="<?php echo $item[1]['user_last_name']; ?>" placeholder="Last Name" title="Enter your last name."/>
								<br>
							</div>
						</div>
				
						<div class="form-group">
							<div class="col-xs-6">
								<label for="phone"><h4>Phone</h4></label>
								<input type="text" class="form-control" name="user_phone" value ="<?php echo $item[1]['user_phone']; ?>" placeholder="Phone" title="Enter your phone."/>
								<br>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="email"><h4>Email</h4></label>
								<input type="email" class="form-control" name="user_email" value="<?php echo $item[1]['user_email']; ?>" placeholder="Email" title="Enter your email." />
								<br>
							</div>
						</div>
							
						<div class="form-group">
							<div class="col-xs-6">
								<label for="password"><h4>New Password</h4></label>
								<input type="password" class="form-control" name="user_password" placeholder="New Password" title="enter your new password."/> 
								<br>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-6">
								<label for="password"><h4>Password</h4></label>
								<input type="password" class="form-control" name="current-password" placeholder="New Password" title="enter your new password."/> 
								<br>
							</div>
						</div>
							
						<div class="form-group">
                           	<div class="col-xs-12">
                                <br>
                              	<input class="btn btn-lg btn-success" type="submit" name="user_submit" value ="save"/>
                               	<button class="btn btn-lg" type="reset" name="reset_button">Reset</button>
                            </div>
                      	</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="container p-5">
<!-- Tasks -->
	<h2 class="text-center">My Tasks</h2>
	<br/><br/><br/><br/><br/>
	<?php include "views/tasks/tasks.php";?>
</div>

<script>
	$(document).ready(function() {
		var readURL = function(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('.avatar').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$(".file-upload").on('change', function(){
			readURL(this);
		});
	});
</script>