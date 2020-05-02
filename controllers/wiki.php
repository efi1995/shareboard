<?php
class Wiki extends Controller{
	protected function Index(){
		$wiki = new WikiModel();
		$this->returnView($wiki->Index(), true);
	}

	protected function Add(){
		$addWiki = new WikiModel();
		$this->returnView($addWiki->Add(), true);
	}
}