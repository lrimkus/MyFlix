<?

class MovieAPI
{
  public function __construct(Movie $movie)
  {
    $this->movie = $movie;
  }

  private function getMovieArray()
  {
    $data = array(
      'ID' => $this->movie->getMovieId(),
      'Title' => $this->movie->getTitle(),
      'Director' => $this->movie->getDirector(),
      'Actors' => $this->movie->getActors(),
      'Genre' => $this->movie->getGenre(),
      'Runtime' => $this->movie->getRunTime(),
      'Plot' => $this->movie->getPlot(),
      'Poster' => $this->movie->getPosterURL(),
      'Rating' => $this->movie->getRating(),
      'Votes' => $this->movie->getVotes(),
      'Year' => $this->movie->getReleaseYear(),
      'Awards' => $this->movie->getAwards()
    );

    return $data;
  }

  public function getMovieJSON()
  {
    $data = $this->getMovieArray();
    return json_encode($data);
  }
}

//end of MovieAPI.php