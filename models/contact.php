<?php
class ContactModel extends Model{
	
	public function Index(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['contact_submit']){
			if ($post['name'] == '' || $post['email'] == '' || $post['message'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			} else {
				//the subject
				$sub = "New message from " . $post['name'];
				//the message
				$msg = $post['message'];
				//recipient email here
				$rec = "efig.1995@gmail.com";
				//send email
				mail($rec,$sub,$msg);
				Messages::setMsg('Your message send', 'successMsg');
				return;
			}
		}

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		return array($projects);
	}
}