<?php
class Tasks extends Controller{
	protected function Index(){
		$viewmodel = new TasksModel();
		$this->returnView($viewmodel->Index(), true);
	}

	protected function Add(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'tasks');
		}
		$viewmodel = new TasksModel();
		$this->returnView($viewmodel->Add(), true);
	}
	
	protected function Update(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'tasks');
		}
		$item = new TasksModel();
		$this->returnView($item->Update(), true);
	}

	protected function Task(){
		if(!isset($_SESSION['is_logged_in'])){
			header('Location: '.ROOT_URL.'tasks');
		}
		$item = new TasksModel();
		$this->returnView($item->Task(), true);
	}
}