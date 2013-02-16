<?
# The config file stores the data that varies from server to server
# This file is overwritten by config.php in th same folder if you store one.

# Do not report errors by default. If you decide to debug the app you should turn this on.
error_reporting(0);

# Default URL for imdb
define("IMDB_URL", 'http://www.imdb.com/title/');

# Database information
$config['dbHost'] = '';
$config['dbUser'] = '';
$config['dbPassword'] = '';
$config['dbName'] = '';
$config['dbType'] = 'mysql';


# Movie Folders on disk. All the movies must contain IMDB id in curly brackets
# Example:  Avatar.2009.{tt0499549}.mkv  or a folder Avatar.2009.{tt0499549}/
# Note: "History" is a reserved folder name for showing movie Log

# $config['folders']['Action'] = '/home/user/movies/action';
# $config['folders']['Drama'] = '/home/user/movies/drama';


# If True it will cache movie data to DB. Without cache it would be crawling
$config['useCache'] = true;

# The location where posters will be saved. must be under /public_html
$config['postersDirectory'] = '/images/posters/';
$config['imagesDirectory'] = '/images/';

#end of config file