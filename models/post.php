<?php
class PostsModel extends Model{

	public function Index(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$id = $_GET['id'];
		if ($post['post_delete']){
			$post_delete_id = $post['post_delete_id'];

			//delete post
			$this->DeletePost($post_delete_id);

			//delete tasks
			$task = new TasksModel();
			$task->DeleteTaskByPostId($post_delete_id);
		}
		$this->query('SELECT * FROM posts ORDER BY post_create_date DESC');
		$posts = $this->resultSet();

		//Projects
		$projects = $this->Projects();

		return array($projects,$posts);
	}

	public function Add(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['post_submit']){
			if ($post['post_title'] == '' || $post['post_body'] == ''){
				Messages::setMsg('Please Fill In All Fields','error');
				return;
			}
			// Insert into MySQL
			$this->AddPost();

			// Verify
			if($this->lastInsertId()){
				header('Location: '.ROOT_URL.'posts');
			}
		}
		//Projects
		$projects = $this->Projects();
		
		return array($projects);
	}

	public function Update(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$id = $_GET['id'];
		$tasks = new TasksModel();
		if ($post['open_push_submit']){
			$open_push = $post['open_push'];
			$task_deadline = $post['task_deadline'];
			$tasks->UpdateUserNameAndDeadline($open_push, $task_deadline);
			$tasks->PushToInProgress($open_push);
			
			header('Location: '.ROOT_URL.'posts/update/' . $id);
		}

		if ($post['in_progress_push_submit']){
			$in_progress_push = $post['in_progress_push'];
			
			$tasks->PushToDone($in_progress_push);
			
			header('Location: '.ROOT_URL.'posts/update/' . $id);
		}

		//Projects
		$projects = $this->Projects();

		// Post Title
		$post_title = $this->GetSinglePostTitle($id);
		
		//Task Status
		$task = new TasksModel();
		$task_status = $task->TaskStatusByPostId($id);

		$status_open = $task_status[0];
	
		$status_in_progress = $task_status[1];

		$status_done = $task_status[2];

		return array($projects, $post_title, $status_open, $status_in_progress, $status_done);
	}

	public function Projects(){
		$this->query('SELECT post_id, post_title FROM posts ORDER BY post_create_date DESC');
		
		$post_title = $this->resultSet();
		return $post_title;
	}
	
	public function AddPost(){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$this->query('INSERT INTO posts (post_title, post_body) VALUES(:post_title, :post_body)');
		$this->bind(':post_title', $post['post_title']);
		$this->bind(':post_body', $post['post_body']);
		$this->execute();
	}

	public function GetSinglePostTitle($id){
		$this->query('SELECT post_title FROM posts WHERE post_id = ' . $id);
		$post_title = $this->single();
		
		return $post_title;
	}

	public function DeletePost($post_delete_id){
		$this->query('DELETE FROM posts WHERE post_id = :post_id');
		$this->bind(':post_id', $post_delete_id);
		$this->execute();
	}
}