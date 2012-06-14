<?php

 //  It could be used to be put remotely (to utilize a faster connection/server), of course it needs ImdbParser class
 // We use it when caching to DB, because it JSON is just easy to use
 
 /* All it needs is the following
  * 
  * require 'MovieData.php'
  * require 'ImdbParser.php';
  * 
  * if (!isset($_GET['i']) || !preg_match('/^tt[0-9]+$/', $_GET['i'])) { die('BAD Movie ID'); }
	$id = $_GET['i'];
  * $data = new JsonAPI($id);
  * print $data->get_json();
  */

 class JsonAPI extends ImdbParser {
		
	public function get_json() {
		
		$data = array (
		
			'ID' 		=> $this->get_imdb_id(),
			'Title' 	=> $this->get_title(),
			'Director' 	=> $this->get_director(),
			'Actors' 	=> $this->get_actors(),
			'Genre' 	=> $this->get_genre(),
			'Rated' 	=> $this->get_rated(),
			'Runtime' 	=> $this->get_runtime(),
			'Plot' 		=> $this->get_plot(),
			'Poster' 	=> $this->get_poster(),
			'Rating' 	=> $this->get_rating(),
			'Votes' 	=> $this->get_votes(),
			'Released' 	=> $this->get_released(),
			'Year' 		=> $this->get_year()
		);
		
		return json_encode($data);
	}
	
}
// end of JsonAPI.php