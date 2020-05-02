<?php
class UserModel extends Model{
	public function Index(){
		//error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$id   = $_SESSION['user_data']['user_id'];
		
		//Update User
	 	if($post['user_submit']){
			 //Check if is Empty
			if($post['user_name'] == '' || $post['user_email'] == '' || $post['user_password'] == '' || 
			   $post['current-password'] == '' || $post['user_first_name'] == '' || $post['user_last_name'] == '' )
			{
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			//Check if pw = Cpw
			if ($post["user_password"] === $post["current-password"]){ 
				$user_name  	 = $post['user_name'];
				$user_first_name = $post['user_first_name'];
				$user_last_name  = $post['user_last_name'];
				$user_email 	 = $post['user_email'];
				$user_phone   	 = $post['user_phone'];
				$user_password 	 = md5($post['user_password']);				

				$this->UpdateUser($user_name, $user_first_name, $user_last_name, $user_phone, $user_email, $user_password, $id);
				header('Location: '.ROOT_URL.'users/index');
			}else {
				Messages::setMsg('Password Dont Match', 'error');
			}
		}

		// User Data
		$user_data = $this->UserData($id);

		//Intex Tasks
		$tasks = new TasksModel();
		$user_tasks = $tasks->GetTaskByUserId($id);

		// Image
		$img = new ImagesModel();
		$img->UploadImages();

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		return array($projects, $user_tasks, $user_data[0]);
	}
	
	public function register(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['user_password']);

		if($post['btn_register']){
			if($post['user_name'] == '' || $post['user_email'] == '' || $post['user_password'] == ''|| $post['current-password'] == '' ){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			if ($post["user_password"] === $post["current-password"]) {
				// Insert into MySQL
				$this->query('INSERT INTO users (user_name, user_email, user_password) 
							  VALUES(:user_name, :user_email, :user_password)'
							);
				$this->bind(':user_name', $post['user_name']);
				$this->bind(':user_email', $post['user_email']);
				$this->bind(':user_password', $password);
				$this->execute();
				// Verify
				if($this->lastInsertId()){
					// Redirect
					header('Location: ' . ROOT_URL . 'users/login');
				}
			} else {
				Messages::setMsg('password is wrong', 'error');
				return;
			}
		}
		return;
	}
	
	public function login(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		$password = md5($post['user_password']);

		if($post['btn_login']){
			// Compare Login
			$this->query('SELECT * FROM users WHERE user_name = :user_name AND user_password = :user_password');
			$this->bind(':user_name', $post['user_name']);
			$this->bind(':user_password', $password);
			
			$row = $this->single();
			if($row){
				$_SESSION['is_logged_in'] = true;
				$_SESSION['user_data'] = array(
					"user_id"	 => $row['user_id'],
					"user_name"	 => $row['user_name'],
					"user_email" => $row['user_email']
				);
				$_SESSION['user_id'] = $row['user_id'];
				header('Location: ' . ROOT_URL);
			} else {
				Messages::setMsg('Incorrect Login', 'error');
			}
		}
		return;
	}
	
	public function AssigneTo(){
		$this->query('SELECT user_name, user_id FROM users');
		$user_name = $this->resultSet();
		
		return $user_name;
	}

	public function UpdateUser($user_name, $user_first_name, $user_last_name, $user_phone, $user_email, $user_password, $id){
		$this->query('UPDATE users 
						SET  user_name = :user_name, 
							user_email = :user_email, 
							user_first_name = :user_first_name, 
							user_last_name = :user_last_name, 
							user_phone = :user_phone, 
							user_password = :user_password 
						WHERE user_id = :user_id'
					);
		$this->bind(':user_name', $user_name);
		$this->bind(':user_first_name', $user_first_name);
		$this->bind(':user_last_name', $user_last_name);
		$this->bind(':user_phone', $user_phone);
		$this->bind(':user_email', $user_email);
		$this->bind(':user_password', $user_password);
		$this->bind(':user_id', $id);
	}

	public function UserData($id){
		$this->query('SELECT * FROM users WHERE user_id = ' . $id);
		$user_data = $this->resultSet();

		return $user_data;
	}

	public function GetUserNameByUserId($id){
		$this->query('SELECT user_name FROM users WHERE user_id = ' . $id);
		$user = $this->resultSet();
		$user_name = $user[0]['user_name'];

		return $user_name;
	}

	public function GetUserNameAndImgByUserId($comments){
		foreach($comments as $key => $value) :
			$this->query('SELECT user_name, user_img FROM users WHERE user_id = ' . $comments[$key]['user_id']);
			$comment = $this->resultSet();

			$user_name = $comment[0]['user_name'];
			$user_img  = $comment[0]['user_img'];

			$comments[$key]['user_name'] = $user_name; 
			$comments[$key]['user_img']  = $user_img;
		endforeach;

		return $comments;
	}

	public function AssigneAndRporterUserNames($status_open){
		foreach($status_open as $key => $value) :
			$this->query('SELECT user_name FROM users WHERE user_id = ' . $status_open[$key]['user_id']);
			$users = $this->resultSet();
			$status_open[$key]['user_name'] = $users[0]['user_name'];
			
			$this->query('SELECT user_name FROM users WHERE user_id = ' . $status_open[$key]['user_id_reporter']);
			$users = $this->resultSet();
			$status_open[$key]['user_neme_reporter'] = $users[0]['user_name'];
		endforeach;
	
		return $status_open;
	}

	public function UpdateUserImg($img, $user_id){
		$this->query('UPDATE users SET user_img = :user_img WHERE user_id = :user_id');
		$this->bind(':user_img', $img);
		$this->bind(':user_id', $user_id);
		$this->execute();	
	}

	public function GetUserImgByUserId($id){		
		$this->query('SELECT user_img FROM users WHERE user_id = ' . $id);
		$user = $this->resultSet();
		
		return $user[0]['user_img'];
	}
}