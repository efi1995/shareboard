<?php
class Home extends Controller{
	protected function Index(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Index(), true);
	}
	
	protected function Main(){
		$viewmodel = new HomeModel();
		$this->returnView($viewmodel->Main(), true);
	}
}