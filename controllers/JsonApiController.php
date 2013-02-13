<?
require_once '../models/Utilities.php';
require_once '../models/MovieAPI.php';
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
    $movieFromImdb = new ImdbParsedMovies(array($this->imdbId));
    $this->movies = $movieFromImdb->getMovies();
    $api = new MovieAPI($this->movies[$this->imdbId]);

    print $api->getMovieJSON();
  }

}

//end of JsonApiController.php