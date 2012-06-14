<?php
// This class does all data and database related operations
// We Use PDO for databases so it could be extended to other DB engines later

class Database { 
	
	private $raw_movies;
	private $feed_ids;
	private $db;
	
	public function __construct($host, $db_name, $dbuzer, $dbpss) { 
		try {
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db_name, $dbuzer, $dbpss);	
			
			$this->db = $dbh;
		
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage();
		    die();
		} 
	}	
	
	public function get_movies($ids) {
		
		$idz = "'".implode("','", $ids)."'"; //so we query for only the ones we need for the page
			
		$sth = $this->db->prepare("SELECT * FROM movies where ID IN (".$idz.") order by title");
		
		$sth->execute();
		
		$result = $sth->fetchAll();
		
		foreach ($result as $v) { $this->raw_movies[$v['ID']] = $v; } //we need imdbIDs as keys of the array
		
		$this->feed_ids = $ids;

		$this->process_movies();
		
		return $this->raw_movies;
	
	}
	
	private function process_movies() { //Cache in DB absent ones, make sure  posters exist
		
		foreach ($this->feed_ids as $id) {
		
			if (!isset($this->raw_movies[$id])) { //we need to insert into DB a movie
				
				 $movie_json = new JsonAPI($id);
				 $json = $movie_json->get_json();
				 $data = json_decode($json, TRUE);
				 
				 //insert into DB
				$query = "INSERT INTO movies (ID, Title, Year, Director, Released, Rating, Votes, Genre, Rated, Runtime, Actors, Plot, Poster) 
				VALUES (
					".$this->db->quote($data['ID']).", 
					".$this->db->quote($data['Title']).", 
					".$this->db->quote($data['Year']).", 
					".$this->db->quote($data['Director']).",
					".$this->db->quote($data['Released']).", 
					".$this->db->quote($data['Rating']).", 
				 	".$this->db->quote($data['Votes']).", 
					".$this->db->quote($data['Genre']).", 
					".$this->db->quote($data['Rated']).", 
					".$this->db->quote($data['Runtime']).", 
					".$this->db->quote($data['Actors']).", 
					".$this->db->quote($data['Plot']).", 
					".$this->db->quote($data['Poster'])."
				)";
				
				$sth = $this->db->prepare($query);
				$sth->execute();
				
				$this->raw_movies[$id] = $data; //we add to all the processed movies within the object
				
				$poster = $data['Poster'];
			}	else { $poster = $this->raw_movies[$id]['Poster']; } 
			
			ImdbParser::thePoster($id, $poster); // $poster is remote filename from imdb
			
		}
		
	
	}
	

	public function get_raw_movies() { return $this->raw_movies; }
	

}
// end of Database.php file