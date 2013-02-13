<?
require_once 'MyMoviesController.php';

class HistoryController extends MyMoviesController
{
  public function __construct(Configuration $config)
  {
    if (!$config->getUseCache()) {
      die ('Cannot look at history in a "non-cached" mode. Please see configuration.');
    }
    parent::__construct($config);
  }

  protected function renderPage()
  {
    $this->currentFolder = 'history';
    $this->prepareMovies();
    require_once '../views/tpl.main.php';
  }

  private function prepareMovies()
  {
    $moviesInHistory = array();

    $idsOnDisk = $this->diskUtility->getAllMoviesIdsOnDisk();
    $moviesFromDB = $this->config->getDbLayer()->getAllMovies();

    foreach ($moviesFromDB as $id => $movie) {
      if (!in_array($id, $idsOnDisk)) {
        $moviesInHistory[$id] = $movie;
      }
    }

    $this->movies = $moviesInHistory;
    $this->diskUtility->savePosters($moviesInHistory);
  }
}

//end of HistoryController.php

