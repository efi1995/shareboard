<?php
class WikiModel extends Model{
	public function Index(){
		error_reporting(0);
		$id = $_GET["id"];
		$wikies = $this->Wiki();
		$wiki = $this->GetWikiDyId($id);

		//Projects
		$post = new PostsModel();
		$projects = $post->Projects();

		return array($projects, $wikies, $wiki);
	}

	public function Add(){
		error_reporting(0);
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
		if ($post['wiki_submit']){
			$wiki_title = $post['wiki_title'];
			$wiki_body  = $post['wiki_body'];
			if ($wiki_title == '' || $wiki_body == ''){
				Messages::setMsg('Please Fill In All Fields','error');
				return;
			}
			$this->AddWiki($wiki_title, $wiki_body);
			Messages::setMsg('Your Wiki is added', 'successMsg');
		}

		return;
	}

	public function Wiki(){
		$this->query('SELECT * FROM wiki');
		$wikies = $this->resultSet();
		return $wikies;
	}

	public function GetWikiDyId($id){
		$this->query('SELECT * FROM wiki WHERE wiki_id = ' . $id);
		$wiki = $this->resultSet();
		return $wiki;
	}

	public function AddWiki($wiki_title, $wiki_body){
		$this->query('INSERT INTO wiki (wiki_title, wiki_body) VALUES(:wiki_title, :wiki_body)');
		$this->bind(':wiki_title', $wiki_title);
		$this->bind(':wiki_body', $wiki_body);
		$this->execute();
	}
}