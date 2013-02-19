<?
require_once '../helpers/Utilities.php';
require_once 'MyMoviesController.php';

class JsonApiController extends MyMoviesController
{
  private $imdbId;

  public function __construct(Configuration $config)
  {
    if (!isset($_GET) || !isset($_GET['id']) || !Utilities:: checkImdbID($_GET['id'])) {
      header('Bad Request', true, 400);
      print '400 Bad Request';
      return;
    }

    $this->imdbId = $_GET['id'];

    parent::__construct($config);
  }

  protected function renderPage()
  {
    $movieData = $this->prepareMovies();
    print  json_encode($movieData);
  }

  private function prepareMovies()
  {
    $movieFromImdb = new ImdbParsedMovies(array($this->imdbId));
    $this->movies = $movieFromImdb->getMovies();
    $movie = $this->movies[$this->imdbId];

    $data = array(
      'ID' => $movie->getMovieId(),
      'Title' => $movie->getTitle(),
      'Director' => $movie->getDirector(),
      'Actors' => $movie->getActors(),
      'Genre' => $movie->getGenre(),
      'Runtime' => $movie->getRunTime(),
      'Plot' => $movie->getPlot(),
      'Poster' => $movie->getPosterURL(),
      'Rating' => $movie->getRating(),
      'Votes' => $movie->getVotes(),
      'Year' => $movie->getReleaseYear(),
      'Awards' => $movie->getAwards()
    );

    return $data;
  }

}

//end of JsonApiController.php