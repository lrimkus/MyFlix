<?php
	//this interface ensures that the movie data from IMDB and movie data from DB has the same structure
	//It is implemented By classes ImdbParser and DBMovie
	
	Interface MovieData {
		
		public function get_imdb_id();
		
		public function get_year(); 
		
		public function get_released();
		
		public function get_title();
		
		public function get_rating(); 
		
		public function get_votes(); 
		
		public function get_director();
		
		public function get_actors();
		
		public function get_genre();
		
		public function get_rated();
		
		public function get_runtime();
		
		public function get_plot();
		
		public function get_poster();
	}
//End of MovieData.php