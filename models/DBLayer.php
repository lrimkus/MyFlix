<?

Class DBLayer
{

  private $dBInstance;

  public function __construct($dbType, $host, $dbName, $dbUser, $dbPass, $useCache)
  {
    if (!$useCache) {
      return false;
    }

    try {
      $this->dBInstance = new PDO($dbType . ':host=' . $host . ';dbname=' . $dbName, $dbUser, $dbPass);
    } catch (PDOException $e) {
      print "Error!: " . $e->getMessage();
      die();
    }
    return true;
  }

  public function getCachedMovies(array $movieIds)
  {
    $stringIds = "'" . implode("','", $movieIds) . "'";

    $query = "SELECT * FROM movies where id IN ($stringIds) order by title";
    $sql = $this->dBInstance->prepare($query);
    $sql->execute();

    $moviesResult = $sql->fetchAll();
    $movies = $this->mapMoviesQuery($moviesResult);

    return $movies;
  }


  public function getAllMovies()
  {
    $query = "SELECT * FROM movies  order by added desc";
    $sql = $this->dBInstance->prepare($query);
    $sql->execute();

    $moviesResult = $sql->fetchAll();
    $movies = $this->mapMoviesQuery($moviesResult);
    return $movies;
  }

  public function insertMovie(Movie $movie)
  {
    $query = "INSERT INTO movies
              (
                id
              , title
              , release_year
              , directors
              , rating
              , votes
              , genre
              , runtime
              , actors
              , plot
              , poster
              , awards
              )
              VALUES
              (
                :id
              , :title
              , :release_year
              , :directors
              , :rating
              , :votes
              , :genre
              , :runtime
              , :actors
              , :plot
              , :poster
              , :awards
              ) ";

    $sql = $this->dBInstance->prepare($query);
    $this->bindMovieValues($movie, $sql);
    $sql->execute();

    return $movie;

  }

  public function updateMovie(Movie $movie)
  {
    $query = "UPDATE  movies
                 SET  title=:title
                    , release_year=:release_year
                    , directors=:directors
                    , rating=:rating
                    , votes=:votes
                    , genre=:genre
                    , runtime=:runtime
                    , actors=:actors
                    , plot=:plot
                    , poster=:poster
                    , awards=:awards
                    , updated=:updated
               WHERE id=:id";

    $sql = $this->dBInstance->prepare($query);

    $this->bindMovieValues($movie, $sql);
    $sql->bindValue(':updated', date("Y-m-d H:i:s"));
    $sql->execute();

  }

  private function mapMoviesQuery($SQLFetchedResult)
  {
    /** @var $movies Movie[] */
    $movies = array();

    foreach ($SQLFetchedResult as $dbRow) {
      $movies[$dbRow['id']] = new Movie(
        $dbRow['title']
        , $dbRow['directors']
        , $dbRow['actors']
        , $dbRow['genre']
        , $dbRow['id']
        , $dbRow['rating']
        , $dbRow['votes']
        , $dbRow['plot']
        , $dbRow['release_year']
        , $dbRow['runtime']
        , $dbRow['poster']
        , $dbRow['awards']
      );
    }

    return $movies;
  }

  private function bindMovieValues(Movie $movie, PDOStatement $sql)
  {
    $sql->bindValue(':id', $movie->getMovieId());
    $sql->bindValue(':title', $movie->getTitle());
    $sql->bindValue(':release_year', $movie->getReleaseYear());
    $sql->bindValue(':directors', $movie->getDirector());
    $sql->bindValue(':rating', $movie->getRating());
    $sql->bindValue(':votes', $movie->getVotes());
    $sql->bindValue(':genre', $movie->getGenre());
    $sql->bindValue(':runtime', $movie->getRunTime());
    $sql->bindValue(':actors', $movie->getActors());
    $sql->bindValue(':plot', $movie->getPlot());
    $sql->bindValue(':poster', $movie->getPosterURL());
    $sql->bindValue(':awards', $movie->getAwards());
  }

}

//end of DBLayer.php