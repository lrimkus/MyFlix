<? 

//IMDB Parser



class ImdbParser implements MovieData {
	
	private $imdb_id;
	private $imdb_html;
	
	public function __construct($id) {
			
		$st = IMDB_URL . $id;
		
		try {
				
			if(($html = file_get_contents($st)) === FALSE)  { throw new Exception('Cannot Access '. $st);  } //read the contents of imdb webpage
			
			$this->imdb_html = $html;
			$this->imdb_id = $id;
			
			ImdbParser::thePoster($id, $this->get_poster()); 
			
		} catch (Exception $e) { echo $e->getMessage(); exit(); }
		
	}
	
	
	
	private function parse_item($preced, $follow, $html) { //get the text between preceding and following code
		
		$o = explode($preced, $html);
				
		$o = explode ($follow, $o[1],2);
		
		return trim($o[0]);
		
	}
	
	private function parse_multiple_items($prop) { //parses multiple items like actors by property
			
		$items = explode('itemprop="'.$prop.'"', $this->imdb_html);	
		
		$data = '';
		
		for($i=1; $i<count($items); $i++) { 
			$data .= $this->parse_item('>', '</a', $items[$i]); 
			if ($i!= count($items)-1)  { $data .= ', '; }
		}
		
		return $data;
	}

	
	public function get_imdb_id() { return $this->imdb_id; }	
	
	public function get_plot() {
		$plot =  $this->parse_item('itemprop="description">', '</p', $this->imdb_html); 
		if (strstr($plot, '<a ')) { $mv = explode('<a ', $plot); $plot = str_replace("\n", "", $mv[0]); }
		return $plot;
	}
		
	public function get_title() { return $this->parse_item('itemprop="name">', '<', $this->imdb_html); }
		
	public function get_director() { return $this->parse_multiple_items('director');  }
		
	public function get_actors() {  return  $this->parse_multiple_items('actors'); }
		
	public function get_genre() { return  $this->parse_multiple_items('genre'); }
	
	public function get_rating() { 	return $this->parse_item('itemprop="ratingValue">', '</', $this->imdb_html); }
		
	public function get_votes() { return $this->parse_item('itemprop="ratingCount">', '</', $this->imdb_html); } 
		
		
		
	public function get_year() { 
		 
		$ss = $this->parse_item('itemprop="name"', '</h1', $this->imdb_html);
		$data['Year'] = $this->parse_item('(', ')', $ss);
		if (strstr($data['Year'], '<a ')) { $data['Year'] = $this->parse_item('>', '<', $data['Year']); }
		
		return $data['Year'];
	
	}
	
	public function get_released() {
		 
		$o = explode('itemprop="datePublished"', $this->imdb_html);
		if (count($o) > 1) { return  $this->parse_item('>', '<', $o[1]);	}
		else {  return 'N/A'; }
	}
		
	public function get_runtime() { 

		$runtime = $this->parse_item('class="infobar">', '&nbsp;', $this->imdb_html);
		
		if (strstr($runtime, '<img')) { //sometimes there is an image near it
			$runtime =  $this->parse_item('>', '&nbsp;', $runtime);
		}
		if (!strstr($runtime, ' min')) { $runtime =  'N/A'; }
		
		return $runtime;
	 }
		
		
	public function get_rated() {
			
		$o = explode('/certificates/', $this->imdb_html);
		
		if (count($o) > 1) {
			 return $this->parse_item('title="', '"', $o[1]);  
		} else {
			 return 'N/A'; 
		}	
			
	}
		
	public function get_poster() {
			
		$o = explode('id="img_primary"', $this->imdb_html);
		return $this->parse_item('src="', '"', $o[1]);
		
	}
	
	public static function thePoster($id, $poster) { //checks, downloads the poster
	
		if (!file_exists('../public_html/images/posters/'.$id.'.jpg')) { //to overcome imdb permissions 
			
			if (strpos($poster, '.jpg')) {
				$image = @file_get_contents($poster);
			} else { //for generic poster
				$image = @file_get_contents('../public_html/images/design/generic.jpg');
			}
			//write the file to the server. The public_html/images/posters has to be writable
			if ($image) {
				$f = fopen('../public_html/images/posters/'.$id.'.jpg', 'wb');
				fwrite($f, $image);
				fclose($f);
			}
		}
		
	}
	
}

//End of ImdbParser.php