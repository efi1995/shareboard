<?php
class Admin extends Controller{
	protected function Index(){
		$AdminPanel = new AdminModel();
		$this->returnView($AdminPanel->Index(), true);
	}
}