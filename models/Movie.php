<?

class Movie
{
  private $title;
  private $director;
  private $actors;
  private $genre;
  private $movieId;
  private $rating;
  private $votes;
  private $plot;
  private $releaseYear;
  private $runTime;
  private $posterURL;
  private $awards;

  public function __construct(
    $title,
    $director,
    $actors,
    $genre,
    $movieId,
    $rating,
    $votes,
    $plot,
    $releaseYear,
    $runTime,
    $posterURL,
    $awards
  )
  {
    $this->title = $title;
    $this->director = $director;
    $this->actors = $actors;
    $this->genre = $genre;
    $this->movieId = $movieId;
    $this->rating = $rating;
    $this->votes = $votes;
    $this->plot = $plot;
    $this->releaseYear = $releaseYear;
    $this->runTime = $runTime;
    $this->posterURL = $posterURL;
    $this->awards = $awards;
  }

  public function setActors($actors)
  {
    $this->actors = $actors;
  }

  public function getActors()
  {
    return $this->actors;
  }

  public function setDirector($director)
  {
    $this->director = $director;
  }

  public function getDirector()
  {
    return $this->director;
  }

  public function setGenre($genre)
  {
    $this->genre = $genre;
  }

  public function getGenre()
  {
    return $this->genre;
  }

  public function setMovieId($movieId)
  {
    $this->movieId = $movieId;
  }

  public function getMovieId()
  {
    return $this->movieId;
  }

  public function setPosterURL($posterURL)
  {
    $this->posterURL = $posterURL;
  }

  public function getPosterURL()
  {
    return $this->posterURL;
  }

  public function setRating($rating)
  {
    $this->rating = $rating;
  }

  public function getRating()
  {
    return $this->rating;
  }

  public function setReleaseYear($releaseYear)
  {
    $this->releaseYear = $releaseYear;
  }

  public function getReleaseYear()
  {
    return $this->releaseYear;
  }

  public function setRunTime($runTime)
  {
    $this->runTime = $runTime;
  }

  public function getRunTime()
  {
    return $this->runTime;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setVotes($votes)
  {
    $this->votes = $votes;
  }

  public function getVotes()
  {
    return $this->votes;
  }

  public function setPlot($plot)
  {
    $this->plot = $plot;
  }

  public function getPlot()
  {
    return $this->plot;
  }

  public function setAwards($awards)
  {
    $this->awards = $awards;
  }

  public function getAwards()
  {
    return $this->awards;
  }
}

//end Movie.php