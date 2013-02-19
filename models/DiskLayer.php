<?

class DiskLayer
{
  private $currentFolder;
  private $movieIds;
  private $config;

  public function __construct(Configuration $config)
  {
    $this->config = $config;
  }

  public function setCurrentFolder($currentFolder)
  {
    $this->currentFolder = $currentFolder;
    $this->movieIds = null;
  }

  public function getCurrentFolder()
  {
    return $this->currentFolder;
  }

  public function getMovieIds()
  {
    if ($this->movieIds) {
      return $this->movieIds;
    }
    else {
      return $this->readMovieFolder($this->currentFolder);
    }
  }

  public function deletePosters(array $movies)
  {
    foreach ($movies as $id => $movie) {
      $filePath = '../public_html/' . $this->config->getPostersDirectory() . $id . '.jpg';
      if (file_exists($filePath)) {
        unlink($filePath);
      }
    }
  }

  /** @var $movies Movie[] */
  public function savePosters($movies)
  {
    $defaultImage = @file_get_contents('../public_html/' . $this->config->getImagesDirectory() . 'design/default.jpg');

    foreach ($movies as $movie) {
      $image = $defaultImage;
      $posterPath = '../public_html/' . $this->config->getPostersDirectory() . $movie->getMovieId() . '.jpg';

      if (file_exists($posterPath)) {
        continue;
      }

      if (strpos($movie->getPosterURL(), '.jpg')) {
        $image = Utilities::getFileData($movie->getPosterURL());
      }

      if ($image) {
        $fileHandle = fopen($posterPath, 'wb');
        fwrite($fileHandle, $image);
        fclose($fileHandle);
      }
    }

  }

  private function readMovieFolder($dir)
  {
    $movieIds = array();

    try {
      $files = scandir($dir);
    } catch (Exception $e) {
      print $e->getMessage();
      exit();
    }

    foreach ($files as $file) {
      $isVisibleFile = (substr($file, 0, 1) != '.');

      if (!$isVisibleFile) {
        continue;
      }

      preg_match("/{(tt[0-9]{6,9})}/", $file, $matches);
      $imdbId = (isset($matches[1])) ? $matches[1] : null;

      if ($imdbId) {
        $movieIds[] = $imdbId;
      }
    }

    $this->movieIds = $movieIds;
    return $movieIds;
  }

  public function getAllMoviesIdsOnDisk()
  {
    $folders = $this->config->getFolders();
    $movieIds = array();

    foreach ($folders as $folderPath) {
      $this->setCurrentFolder($folderPath);
      $ids = $this->getMovieIds();
      $movieIds = array_merge($ids, $movieIds);
    }

    return $movieIds;
  }

}
//end of DiskLayer.php