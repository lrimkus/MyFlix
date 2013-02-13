<?
require_once 'MyMoviesController.php';
require_once '../models/Utilities.php';

class RefreshMovieController extends MyMoviesController
{
  protected $imdbId;
  protected $dbLayer;

  public function __construct(Configuration $config)
  {
    $this->dbLayer = $config->getDbLayer();

    if (!isset($_POST['movieId']) || !Utilities:: checkImdbID($_POST['movieId'])) {
      header('Bad Request', true, 400);
      print '400 Bad Request';
      return;
    }

    $this->imdbId = $_POST['movieId'];

    parent::__construct($config);
  }

  protected function renderPage()
  {
    $this->prepareMovies();
    require_once '../views/tpl.movieBox.php';
  }

  private function prepareMovies()
  {
    $movieFromImdb = new ImdbParsedMovies(array($this->imdbId));
    $this->movies = $movieFromImdb->getMovies();
    $this->dbLayer->updateMovie($this->movies[$this->imdbId]);

    $this->diskUtility->deletePosters($this->movies);
    $this->diskUtility->savePosters($this->movies);
  }

}

//end of MoviePageController.php