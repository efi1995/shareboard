<?php
class HomeModel extends Model{
	
	public function Index(){
		error_reporting(0);
		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();
		return array($projects);		
	}
	
	public function Main(){
		return;
	}
}