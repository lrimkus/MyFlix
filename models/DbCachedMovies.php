<?

class DbCachedMovies
{
  protected $config;
  protected $dbLayer;
  protected $movieIds;
  /** @var $movies Movie[] */
  protected $movies;
  protected $newMoviesAdded;

  public function __construct(Configuration $config, array $movieIds)
  {
    $this->config = $config;
    $this->movieIds = $movieIds;
    $this->newMoviesAdded = false;
    $this->dbLayer = $this->config->getDbLayer();

    $this->getCachedMovies();
  }

  private function getCachedMovies()
  {
    $this->movies = $this->dbLayer->getCachedMovies($this->movieIds);

    if ($this->config->getUseCache()) {
      $this->cacheMissingMovies();
    }

    return $this->movies;
  }

  private function cacheMissingMovies()
  {
    $missingMovies = array();

    foreach ($this->movieIds as $id) {
      if (!isset($this->movies[$id])) {
        $missingMovies[] = $id;
      }
    }

    if (empty($missingMovies)) {
      return null;
    }

    $this->newMoviesAdded = true;
    $moviesFromImdb = new ImdbParsedMovies($missingMovies);
    $movieData = $moviesFromImdb->getMovies();

    /**  @var $cachedMovie Movie */
    foreach ($movieData as $cachedMovie) {
      $this->dbLayer->insertMovie($cachedMovie);
      $this->movies[$cachedMovie->getMovieId()] = $cachedMovie;
    }

  }

  public function getNewMoviesAdded()
  {
    return $this->newMoviesAdded;
  }

  /**
   * @return Movie[]
   */
  public function getMovies()
  {
    return $this->movies;
  }

}

// end of DbCachedMovies.php file