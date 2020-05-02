<?php
class TasksModel extends Model{

	public function Index(){
		//error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['task_delete']){
			$task_delete_id = $post['task_delete_id'];
			$this->DeleteTask($task_delete_id);
		}
		$open_tasks = $this->TasksStatusOpen();

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		return array($projects, $open_tasks);
	}
	
	public function Add(){
		//error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['task_submit']){
			if($post['task_title'] == '' || $post['task_body'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			$id            	  = $_GET["id"];
			$task_title    	  = $post['task_title'];
			$task_body     	  = $post['task_body'];
			$user_id_reporter = $post['user_id_reporter'];
			$user_id          = $post['user_id'];
			$this->AddTask($id, $task_title, $task_body, $user_id, $user_id_reporter);
			// Message & Redirect
			Messages::setMsg('Your Task is added', 'successMsg');
		}
		//Assigne to
		$users = new UserModel();
		$user_id = $users->AssigneTo();

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		return array($projects, $user_id);
	} 

	public function Update(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$id = $_GET["id"];
		$user_id = $_SESSION['user_data']['user_id'];
		
		if($post['task_submit']){
			$task_title    = $post['task_title'];
			$task_body     = $post['task_body'];
			$task_id       = $post['task_id'];
			$user_id       = $post['user_id'];
			$task_deadline = $post['task_deadline'];
			$task_status   = $post['task_status'];
			$task_priority = $post['task_priority'];
			$task_type     = $post['task_type'];
			// Update Task
			$this->UpdateTask($task_title, $task_body, $task_id, $user_id, $task_deadline, $task_status, $task_priority, $task_type);
		}

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		//Assigne to
		$users = new UserModel();
		$assigne_to = $users->AssigneTo();
		
		// Get tasks by task id
		$task = $this->GetTask($id);
		
		// Add comment
		$comments = new CommentsModel();
		$comments->addComments($id);

		// Get all comments
		$get_comments = $comments->GetCommentsByTaskId($id);

		// Get log in user img
		$users = new UserModel();
		$user_img = $users->GetUserImgByUserId($user_id);

		return array($projects, $task, $get_comments, $assigne_to, $user_img);
	}

	public function Task(){
		return; 
	}	

	public function TaskStatusByPostId($id){
		//Intex Tasks status open
		$this->query('SELECT * FROM tasks WHERE task_status = 0 AND post_id = ' . $id);
		$status_open = $this->resultSet();
		$user = new UserModel();
		$status_open = $user->AssigneAndRporterUserNames($status_open);

		//Intex Tasks status in progress
		$this->query('SELECT * FROM tasks WHERE task_status = 1 AND post_id = ' . $id);
		$status_in_progress = $this->resultSet();
		$status_in_progress = $user->AssigneAndRporterUserNames($status_in_progress);

		//Intex Tasks status done
		$this->query('SELECT * FROM tasks WHERE task_status = 2 AND post_id = ' . $id);
		$status_done = $this->resultSet();
		$status_done = $user->AssigneAndRporterUserNames($status_done);

		return array($status_open, $status_in_progress, $status_done);
	}

	public function DeleteTask($task_delete_id){
		$this->query('DELETE FROM tasks WHERE task_id = :task_id');
		$this->bind(':task_id', $task_delete_id);
		$this->execute();
	}

	public function TasksStatusOpen(){
		$this->query('SELECT * FROM tasks WHERE task_status = 0');
		$open_tasks = $this->resultSet();
		return $open_tasks;
	}

	public function AddTask($id, $task_title, $task_body, $user_id, $user_id_reporter){
		// Insert into MySQL
		$this->query('INSERT INTO tasks (task_title, task_body, post_id, user_id, user_id_reporter) VALUES(:task_title, :task_body, :post_id, :user_id, :user_id_reporter)');
		$this->bind(':task_title', $task_title);
		$this->bind(':task_body', $task_body);
		$this->bind(':user_id', $user_id);
		$this->bind(':user_id_reporter', $user_id_reporter); 
		$this->bind(':post_id', $id);
		
		$this->execute();
	}

	public function UpdateTask($task_title, $task_body, $task_id, $user_id, $task_deadline, $task_status, $task_priority, $task_type){
		$this->query('UPDATE tasks SET task_title = :task_title, task_body = :task_body, user_id = :user_id, task_deadline = :task_deadline, task_status = :task_status, task_priority = :task_priority, task_type = :task_type WHERE task_id = :task_id ');
		$this->bind(':task_title', $task_title);
		$this->bind(':task_body', $task_body);
		$this->bind(':task_id', $task_id);
		$this->bind(':user_id', $user_id);
		$this->bind(':task_deadline', $task_deadline);
		$this->bind(':task_status', $task_status);
		$this->bind(':task_priority', $task_priority);
		$this->bind(':task_type', $task_type);

		$this->execute();
	}

	public function GetTasks(){
		$this->query('SELECT * FROM tasks');
		$tasks = $this->resultSet();
		return $tasks;
	}

	public function GetTask($id){
		$this->query('SELECT * FROM tasks WHERE task_id = ' . $id);
		$task = $this->single();
		$task = $this->AssigneAndRporterUserName($task);
		
		return $task;
	}

	public function AssigneAndRporterUserName($task){
		// Assigne to
		$user_id = $task["user_id"];
		$user = new UserModel();
		$task['user_name'] = $user->GetUserNameByUserId($user_id);

		// Reporter
		$user_id_reporter = $task["user_id_reporter"];
		$user = new UserModel();
		$task['user_name_reporter'] = $user->GetUserNameByUserId($user_id_reporter);

		return $task;
	}


	public function DeleteTaskByPostId($post_delete_id){
		$this->query('DELETE FROM tasks WHERE post_id = :post_id');
		$this->bind(':post_id', $post_delete_id);
		$this->execute();
	}
	
	public function PushToInProgress($open_push){
		$this->query('UPDATE tasks SET task_status = :task_status WHERE task_id = :task_id');
		$this->bind(':task_status', 1);
		$this->bind(':task_id', $open_push);
		$this->execute();
	}

	public function PushToDone($in_progress_push){
		$this->query('UPDATE tasks SET task_status = :task_status WHERE task_id = :task_id');
		$this->bind(':task_status', 2);
		$this->bind(':task_id', $in_progress_push);
		$this->execute();
	}

	public function UpdateUserNameAndDeadline($open_push, $task_deadline){
		$this->query('UPDATE tasks SET user_id = :user_id, task_deadline = :task_deadline WHERE task_id = :task_id');
		$this->bind(':user_id', $_SESSION['user_data']['user_id']);
		$this->bind(':task_deadline', $task_deadline);
		$this->bind(':task_id', $open_push);
		$this->execute();
	}

	public function GetTaskByUserId($id){
		$this->query('SELECT * FROM tasks WHERE user_id =' . $id);
		$tasks = $this->resultSet();
		return $tasks;
	}
}