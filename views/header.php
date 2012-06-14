<!DOCTYPE html>
<html>
	<head>
		<title>MyMovies Database</title>
		<link type="text/css" href="main.css" rel="stylesheet">
		<meta name="apple-mobile-web-app-status-bar-style" content="default" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<link rel="apple-touch-icon" href="images/design/apple-touch-icon.png" />
		<link rel="apple-touch-startup-image" media="(device-width: 768px)  and (orientation: portrait)  and (-webkit-device-pixel-ratio: 2)"  href="images/design/apple-touch-startup-image-1536x2008.png" />
		<link rel="apple-touch-startup-image" media="(device-width: 768px)  and (orientation: landscape)  and (-webkit-device-pixel-ratio: 2)"  href="images/design/apple-touch-startup-image-1496x2048.png" />
		<link href="images/design/apple-touch-startup-image-640x920.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
		<script type="text/javascript" src="js/iPadhack.js"></script>
	</head>
	<body> 
		
		<div id="main">
			<div id="menu">
				<ul>
					<?php  
						$i=1; 
						foreach ($this->all_folders as $title => $sName) { 
							print '<li ';
							print ($this->folder== $sName) ? "class='actn'" : "";
							print '><a href="?id='.$i.'">'.$title.'</a></li>';
						 $i++;
					} ?>			
				</ul>					 
			</div>
			
			
			<div id="content">