<?

if (file_exists('../config/config.php')) {
  require_once '../config/config.php';
}
else {
  require_once '../config/DefaultConfig.php';
}

/** @param $config array */
require_once '../models/Configuration.php';
$configuration = new Configuration($config);

if (isset($_GET['id']) && $_GET['id'] == 'history') {
  require_once '../controllers/HistoryController.php';
  new HistoryController($configuration);
  return;
}

if (isset($_POST['movieId'])) {
  require_once '../controllers/RefreshMovieController.php';
  new RefreshMovieController($configuration);
  return;
}

require_once '../controllers/MoviePageController.php';
new MoviePageController($configuration);

//end of index.php file

