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
    include '../views/tpl.main.php';
  }

  private function prepareMovies()
  {
    $this->diskLayer->setCurrentFolder($this->currentFolder);
    $movieIds = $this->diskLayer->getMovieIds();

    if ($this->config->getUseCache()) {
      $cachedMovies = new DbCachedMovies($this->config, $movieIds);
      $this->movies = $cachedMovies->getMovies();

      if ($cachedMovies->getNewMoviesAdded()) {
        $this->diskLayer->savePosters($this->movies);
      }
    }
    else {
      $movieFromImdb = new ImdbParsedMovies($movieIds);
      $this->movies = $movieFromImdb->getMovies();
      $this->diskLayer->savePosters($this->movies);
    }
  }

}

//end of MoviePageController.php
