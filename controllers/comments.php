<?php
class Comment extends Controller{
	protected function Index(){
		$comments = new CommentsModel();
		$this->returnView($comments->Index(), true);
	}
}