<?php
class CommentsModel extends Model{

    public function GetCommentsByTaskId($id){
		$this->query('SELECT * FROM comments WHERE task_id = ' . $id);
		$comments = $this->resultSet();

		$user = new UserModel();
		$comments = $user->GetUserNameAndImgByUserId($comments);

		return $comments;
	}
	
	public function addComments($id){
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if($post['comment_submit']){
			if($post['comment_body'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}
			$comment_body = $post['comment_body'];
			$user_id      = $_SESSION['user_data']['user_id'];

			// Insert into MySQL
			$this->query('INSERT INTO comments (task_id, comment_body, user_id) VALUES (:task_id, :comment_body, :user_id)');
			$this->bind(':task_id', $id);
			$this->bind(':comment_body', $comment_body);
			$this->bind(':user_id', $user_id);
			
			$this->execute();
			// Message & Redirect
			Messages::setMsg('Your Comment is added', 'successMsg');
		}
	}
}