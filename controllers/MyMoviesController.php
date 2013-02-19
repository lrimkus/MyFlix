<?
require_once '../models/ImdbParsedMovies.php';
require_once '../models/Movie.php';
require_once '../models/DiskLayer.php';

abstract class MyMoviesController
{
  protected $movies;
  protected $currentFolder;
  protected $config;
  protected $diskLayer;

  public function __construct(Configuration $config)
  {
    $this->config = $config;
    $this->diskLayer = new DiskLayer($config);
    $this->folders = $this->config->getFolders();

    $this->renderPage();
  }

  abstract protected function renderPage();

  public function getMovies()
  {
    return $this->movies;
  }

  public function getCurrentFolder()
  {
    return $this->currentFolder;
  }

  public function getConfig()
  {
    return $this->config;
  }
}

//end of MyMoviesController.php