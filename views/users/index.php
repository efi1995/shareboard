<?php 
    $id = $_GET["id"];
    $users = $viewmodel[2];
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="user_id" value="<?php echo $users['user_id']; ?>">

    <!-- Masthead -->
    <header class="row user_background" style="height:40%;position:relative">
        <div class="bottom-container activity" style="position:absolute;bottom:0;width:100%;height:16%">
            <div class="row">
                <div class="col-sm-5"></div>
                <div class="col-sm-2">
                    <div class="row text-center">37</div>
                    <div class="row"><strong>Posts</strong></div>
                </div>
                <div class="col-sm-2">
                    <div class="row">37</div>
                    <div class="row"><strong>Tasks</strong></div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </header>
    <!-- Profile Image -->
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-5 text-center" style="margin-top:-8%">
            <?php if(!empty($users["user_img"])){?>
                <img src='<?php echo ROOT_PATH; ?>img/profile-images/<?php echo $users["user_img"]; ?>' name="user_img" class="avatar img-circle img-thumbnail" alt="avatar">
            <?php } else { ?>
                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" name="user_img" class="avatar img-circle img-thumbnail" alt="avatar">
            <?php } ?>
            <input type="file" class="text-center center-block file-upload" name="fileToUpload" id="fileToUpload">
            <input class="btn btn-success" type="submit" name="image_submit" value ="Upload Image"/>
        </div>
        <div class="col-sm-3" style="position:relative">
            <h2><input type="text" name="user_name" value ="<?php echo $users['user_name'];?>" style="position:absolute;bottom:0;"/></h2>
        </div>
        <div class="col-sm-3" style="position:relative">
			<a href="#tasks" class="btn btn-primary" style="position:absolute;bottom:0;">Tasks</a>
        </div>
    </div>
    <!-- Details -->
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div id="details" style="margin-left:20px;width:100%">
                <div class="tab-content">
                    <div class="tab-pane active" id="home" style="margin-top:50px;">
                        <hr>
                    
                        <div class="form-group" >
                            <div class="col-xs-6">
                                <label for="first_name"><h4>First name</h4></label>
                                <input type="text" class="form-control" name="user_first_name" value ="<?php echo $users['user_first_name']; ?>" placeholder="First Name" title="Enter your first name."/>
                                <br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="last_name"><h4>Last name</h4></label>
                                <input type="text" class="form-control" name="user_last_name" value ="<?php echo $users['user_last_name']; ?>" placeholder="Last Name" title="Enter your last name."/>
                                <br>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="phone"><h4>Phone</h4></label>
                                <input type="text" class="form-control" name="user_phone" value ="<?php echo $users['user_phone']; ?>" placeholder="Phone" title="Enter your phone."/>
                                <br>
                            </div>
                        </div>

                    <div class="form-group">
                            <div class="col-xs-6">
                                <label for="email"><h4>Email</h4></label>
                                <input type="email" class="form-control" name="user_email" value="<?php echo $users['user_email']; ?>" placeholder="Email" title="Enter your email." />
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
        <div class="col-sm-2"></div>
    </div>
    
    <!-- Tasks -->
    <div class="row" id="tasks">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <h2 class="text-center">My Tasks</h2>
            <br/><br/>
            <?php foreach($viewmodel[1] as $task) : ?>
                <div class="row"style="margin-left:-260px">
                <script src="https://kit.fontawesome.com/a076d05399.js"></script>
                    <div class="vl" style="float:left;margin-right:50px;margin-top:0px;margin-bottom:40px;">
                        <i class="fas fa-cloud" style="margin-left:15px;margin-top:15px;"></i>
                    </div>
                    <div class="speech-bubble text-center" style="padding:15px;">
                        <a name="task_edit" href="<?php echo ROOT_PATH; ?>tasks/update/<?php echo $task['task_id']; ?>">
                        <h4 class="task-title"><?php echo $task['task_title']; ?></h4></a>
                    </div>
                </div>
            <?php endforeach;?>
    </div>
        <div class="col-sm-2"></div>
    </div>
    <br><br><br>
</form>