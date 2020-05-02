<?php
class Posts extends Controller{
	protected function Index(){
		$viewmodel = new PostsModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function Add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'posts');
		}
		$viewmodel = new PostsModel();
		$this->returnView($viewmodel->Add(), true);
	}
	
	protected function Update(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'posts');
		}
		$item = new PostsModel();
		$this->returnView($item->Update(), true);

	}
}