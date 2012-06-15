<?php

class main_controller
{
	private $folder; //keep the current folder name
	
	private $all_folders; //all the folder names
	
	private $live; // if we want to do without caching in database
	
	private $movie_obj; //we store every movie as a separate object in this array
	
	private $page_id;
	
	public function __construct($folders, $db_info, $live=FALSE) {
		
		$this->all_folders = $folders;
		$this->db_info = $db_info;
		$this->live = $live;
		
		if (!isset($_GET['id']) || $_GET['id'] > count($this->all_folders) || preg_match('/^[1-9]$/', $_GET['id']) != 1) { //validate ID
			 $this->page_id  = 1; 
		} else { $this->page_id = $_GET['id']; }
		
		//So What folder are we talking about??
		$folder_names = array_values($this->all_folders);
		$this->folder = $folder_names[$this->page_id- 1];
		
		$this->prepare_model();
		$this->show_page();
	}

	private function prepare_model()
	{
		//get the file list from the disk
		$movies = new Files($this->folder);
		$movie_ids = $movies->get_movie_ids();
		
		
		if ($this->live === TRUE) { // if we DONT want to use database
		
			foreach($movie_ids as $movie_id) {  $this->movie_obj[] = new ImdbParser($movie_id);  }	
		} 
		else { //if we want to stream it from DB cache (and use imdb only or absent movies)
			
			$db_movies = new Database($this->db_info['host'], $this->db_info['db_name'], $this->db_info['dbuzer'], $this->db_info['dbpss']);
			$bulk_movies = $db_movies->get_movies($movie_ids);
			
			foreach ($bulk_movies as $k=>$v) { $this->movie_obj[] = new DBMovie($v); }
		}
	}
	

	public function get_page_id() { return $this->page_id; }
	
	public function get_folder_name() { return $this->folder; }
	
	private function show_page()
	{	
		$movie_count = count($this->movie_obj);
		
		include '../views/header.php';
		
		include '../views/movie_box.php';
		
		include '../views/footer.php';
	}
}

//end of maincontroller.php