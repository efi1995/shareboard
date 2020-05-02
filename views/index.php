<?php
// Start Session
session_start();

// Include Config
require('config.php');

require('classes/Messages.php');
require('classes/Bootstrap.php');
require('classes/Controller.php');
require('classes/Model.php');

require('controllers/home.php');
require('controllers/posts.php');
require('controllers/users.php');
require('controllers/tasks.php');
require('controllers/contact.php');
require('controllers/text-editor.php');
require('controllers/wiki.php');
require('controllers/comments.php');
require('controllers/admin.php');


require('models/home.php');
require('models/post.php');
require('models/user.php');
require('models/task.php');
require('models/contact.php');
require('models/text-editor.php');
require('models/wiki.php');
require('models/comment.php');
require('models/img.php');
require('models/admin.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->createController();
if($controller){
	$controller->executeAction();
}