<?php

//This class scans the directory for items that have {imdbId} included in their name

class Files {
	
	private $directory;
	private $movie_ids = array();
	private $files;
	
	public function __construct($dir) {
		
		try {
				
			if (($files = scandir(MOVIES_PATH . $dir)) == FALSE) { throw new Exception ("Error: System cannot find folder " . $dir); }	
			
			$this->directory = MOVIES_PATH . $dir;
			$this->files = $files;
		}
		catch (Exception $e) { print $e->getMessage(); exit(); }
	}
	
	
	private function extract_ids() { //Scan the files array and extract IDs
		
		foreach ($this->files as $file) {
							
			$hidden = (substr($file, 0, 1) == '.'); //hidden, and directory items
 			
 			$imdb_id  = (!strpos($file, '}')) ? NULL : substr($file, (strpos($file, '{') + 1), (strpos($file, '}') - (strpos($file, '{') + 1))); //extract IMDB ID
 			
 			if ($hidden === TRUE || !$imdb_id) { continue; } 
			
			$this->movie_ids[] = $imdb_id;	
		}
		
	}

	public function get_movie_ids() {
		$this->extract_ids();
		return $this->movie_ids;
	}

	public function get_dir() {
		return $this->directory;	
	}
	
	public function get_dir_contents() {
		return $this->files;	
	}
	
	
}

//end of Files.php