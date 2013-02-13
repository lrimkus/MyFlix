<?

if (file_exists('../config/config.php')) {
  require_once '../config/config.php';
}
else {
  require_once '../config/DefaultConfig.php';
}

require_once '../models/Configuration.php';
require_once '../controllers/JsonApiController.php';

/** @param $config array */
$configuration = new Configuration($config);

new JsonApiController($configuration);

//end of movie.php file