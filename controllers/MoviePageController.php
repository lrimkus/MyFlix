<?
require_once '../models/DbCachedMovies.php';
require_once 'MyMoviesController.php';

class MoviePageController extends MyMoviesController
{
  private $pageId = 1;

  protected function renderPage()
  {
    $folderNames = array_values($this->config->getFolders());

    if (isset($_GET['id']) && isset($folderNames[$_GET['id'] - 1])) {
      $this->pageId = $_GET['id'];
    }

    $this->currentFolder = $folderNames[$this->pageId - 1];
    $this->prepareMovies();
    require_once '../views/tpl.main.php';
  }

  private function prepareMovies()
  {
    $this->diskUtility->setCurrentFolder($this->currentFolder);
    $movieIds = $this->diskUtility->getMovieIds();

    if ($this->config->getUseCache()) {
      $cachedMovies = new DbCachedMovies($this->config, $movieIds);
      $this->movies = $cachedMovies->getMovies();

      if ($cachedMovies->getNewMoviesAdded()) {
        $this->diskUtility->savePosters($this->movies);
      }
    }
    else {
      $movieFromImdb = new ImdbParsedMovies($movieIds);
      $this->movies = $movieFromImdb->getMovies();
      $this->diskUtility->savePosters($this->movies);
    }
  }

}

//end of MoviePageController.php