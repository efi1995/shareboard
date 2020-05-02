<?php
class TextEditor extends Controller{
	protected function Index(){
		$viewmodel = new TextEditorModel();
		$this->returnView($viewmodel->Index(), true);
	}
}