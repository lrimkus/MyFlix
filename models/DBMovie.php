<?php
//We implement Movie Data interface here because it is a blueprint for data source (in case we have some others in the future.) 
//This interface is also implemented by imdbparser

class DBMovie implements  MovieData {
			
		private $data;
		
		public function __construct($data) {
			$this->data = $data;
		}	
			
		public function get_imdb_id() { return $this->data['ID']; }
		
		public function get_year() { return $this->data['Year']; }
		
		public function get_released() { return $this->data['Released']; }
		
		public function get_title() { return $this->data['Title']; }
		
		public function get_rating() { return $this->data['Rating']; }
		
		public function get_votes() { return $this->data['Votes']; }
		
		public function get_director() { return $this->data['Director']; }
		
		public function get_actors() { return $this->data['Actors']; }
		
		public function get_genre() { return $this->data['Genre']; }
		
		public function get_rated() { return $this->data['Rated']; }
		
		public function get_runtime() { return $this->data['Runtime']; }
		
		public function get_plot() { return $this->data['Plot']; }
		
		public function get_poster() { return $this->data['Poster']; }
		
	}

//end of DBMovie.php file