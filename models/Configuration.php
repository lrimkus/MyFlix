<?
require_once 'DBLayer.php';

class Configuration
{
  private $folders;
  private $useCache;
  private $dbLayer;
  private $imagesDirectory;
  private $postersDirectory;

  public function __construct(array $config)
  {
    $this->folders = $config['folders'];
    $this->useCache = $config['useCache'];
    $this->imagesDirectory = $config['imagesDirectory'];
    $this->postersDirectory = $config['postersDirectory'];

    if ($this->useCache) {
      $this->dbLayer = new DBLayer($config['dbType'], $config['dbHost'], $config['dbName'], $config['dbUser'], $config['dbPassword'], $this->useCache);
    }

  }

  public function setFolders($folders)
  {
    $this->folders = $folders;
  }

  public function getFolders()
  {
    return $this->folders;
  }

  public function setUseCache($useCache)
  {
    $this->useCache = $useCache;
  }

  public function getUseCache()
  {
    return $this->useCache;
  }

  public function setImagesDirectory($postersDirectory)
  {
    $this->imagesDirectory = $postersDirectory;
  }

  public function getImagesDirectory()
  {
    return $this->imagesDirectory;
  }

  /**
   * @return DBLayer
   */
  public function getDbLayer()
  {
    return $this->dbLayer;
  }

  public function setPostersDirectory($postersDirectory)
  {
    $this->postersDirectory = $postersDirectory;
  }

  public function getPostersDirectory()
  {
    return $this->postersDirectory;
  }

}
//end of Configuration.php