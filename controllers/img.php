<?php
class Img extends Controller{
	protected function Index(){
		$viewmodel = new ImgModel();
		$this->returnView($viewmodel->Index(), true);
	}
}