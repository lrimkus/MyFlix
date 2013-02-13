<?
error_reporting(1);
//the config file stores the data that varies from server to server

define("IMDB_URL", 'http://www.imdb.com/title/');

//database stuff
$config['dbHost'] = 'localhost';
$config['dbUser'] = 'movies';
$config['dbPassword'] = 'moviefreak';
$config['dbName'] = 'mymovies';
$config['dbType'] = 'mysql';


//Movie Folders on disk. All the movies must contain IMDB id in curly brackets
//Example:  Avatar.2009.{tt0499549}.mkv  or a folder Avatar.2009.{tt0499549}/
// Note: "History" is a reserved folder name for showing movie Log

$config['folders']['unseen'] = '/home/yablinksht/movies/HD_NOT_SEEN';
$config['folders']['collection'] = '/home/yablinksht/movies/COLLECTION';
$config['folders']['seen'] = '/home/yablinksht/movies/HD_SEEN';
//$config['folders']['test'] = '/home/yablinksht/movies/TEST_MOVIES';

//If True it will cache movie data to DB. Without cache it would be crawling
$config['useCache'] = true;

//The location where posters will be saved. must be under /public_html
$config['postersDirectory'] = '/images/posters/';
$config['imagesDirectory'] = '/images/';

//end of config file