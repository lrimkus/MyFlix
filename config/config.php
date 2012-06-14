<?php
error_reporting(0);
	//the config file stores the data that varies from server to server
	
	//general path of the folder on the server
	define ('MOVIES_PATH' , ''); //like /home/john/movies/
	define("IMDB_URL", 'http://www.imdb.com/title/');
	
	//database stuff
	$db_info['host'] = '';
	$db_info['dbuzer'] = ''; 
	$db_info['dbpss'] =  '';
	$db_info['db_name'] = '';
	
	//the folders for movies. All the movies must contain imdb id in curly brackets like Avatar.2009.{tt0499549}.mkv
	$folders['useen'] = 'HD_NOT_SEEN';
	$folders['collection'] = 'COLLECTION';
	$folders['seen'] = 'HD_SEEN';
	
	//if is_live is true, every time the page loads, it pulls all the info from imdb. 
	//It takes a while, this is why it is disdabled by default
	$is_live = FALSE;
	
	
	/* Database Structrue
	 * 
		CREATE TABLE IF NOT EXISTS `movies` (
		  `ID` text NOT NULL,
		  `Title` text NOT NULL,
		  `Year` text NOT NULL,
		  `Director` text NOT NULL,
		  `Released` text NOT NULL,
		  `Rating` text NOT NULL,
		  `Votes` text NOT NULL,
		  `Genre` text NOT NULL,
		  `Rated` text NOT NULL,
		  `Runtime` text NOT NULL,
		  `Actors` text NOT NULL,
		  `Plot` text NOT NULL,
		  `Poster` text NOT NULL,
		  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
		) ENGINE=MyISAM DEFAULT CHARSET=latin1;
	 * 
	 */
	
//end of config file