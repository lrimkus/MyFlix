MyMovies-DB
===========

	
If you have a media server at home, or perhaps just have movies on your PC HDD and figure you want to watch something.. How do you do it? Most probably you look at those titles, go to imdb.com look at ratings, descriptions and try to make your choice. Well, this is a perfect solution for you. 
This application scans  your folders, and get all that info from imdb.com for you. It creates a nice interface and is designed to be used on pc as well as mobile devices.

Initially this was a one-night project done in a dirty code.  However, decided to release it to Github, so it took another night to recode it to OOP PHP. 

Please read IMDB.com terms and conditions on how you can use the data from them.

Features
<ul>
	<li>Makes a nice page out of your movies directory, so you can pick a movie sitting on your couch using your iPad.</li>
	<li>Navigation between movie directories (i.e. you can categorize them as "seen", "favorites", "not seen"</li>
	<li>Uses HTML5, so is suited for mobile devices.</li>
	<li>You can use it from your computer too.</li>
	<li>When saved on home screen in iOS devices it looks like a native app (no Safari chrome, no tabs).</li>
	<li>Has an icon and splash screen for iOS.</li>
</ul>	
Requirements
<ul>
 	<li>Web server</li>
 	<li>PHP > 5</li>
 	<li>MySQL (currently, there is place for other DB plug-ins)</li>
</ul> 
 To Do
 <ul>
 	<li>Initialization script that creates a DB and chmods a posters folder</li>
 	<li>Write an extension for SQLite and PgSQL</li>
 	<li>Implement data updating in DB for cached movies (because ratings and number of Votes constantly change</li>
	<li>favicon.ico</li>
	<li>Add a page that shows all of the movies from DB (so the user knows what was seen)</li>
	<li>Paging</li>
	<li>Sorting</li>
	<li>A button that refreshes data about a movie from IMDB on demand.</li>
	<li>Search quickly made with javascript</li>
</ul>