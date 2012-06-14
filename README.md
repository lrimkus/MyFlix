MyMovies-DB
===========

MyMovies DB
	
	If you have a media server at home, or perhaps just have movies on your PC HDD and figure you want to watch something.. How do you do it? Most probably you look at those titles, go to imdb.com look at ratings, descriptions and try to make your choice. Well, this is a perfect solution for you. This application scans your folders, and get all that info from imdb.com for you. It creates a nice interface and is designed to be used on pc as well as mobile devices.

	Initially this was a one-night project done in a dirty code. However, decided to release it to Github, so it took another night to recode it to OOP PHP. 

	Please read IMDB.com terms and conditions on how you can use the data from them.

Features
	- Makes a nice page out of your movies directory, so you can pick a movie sitting on your couch using your iPad.
	- Navigation between movie directories (i.e. you can categorize them as "seen", "favorites", "not seen"
	- Uses HTML5, so is suited for mobile devices.
	- You can use it from your computer too.
	- When saved on dashboard in iOS works as a native app (no Safari chrome, no tabs).
	- Has an icon and splash screen for iOS.
	
Requirements
 	- Web server
 	- PHP > 5
 	- MySQL (currently, there is place for other DB plug-ins)
 
 To Do:
 	- Initialization script that creates a DB and chmods a posters folder
 	- Write an extension for SQLite and PgSQL
 	- Implement data updating in DB for cached movies (because ratings and number of Votes constantly change
	- favicon.ico
	- Add a page that shows all of the movies from DB (so the user knows what was seen)
	- Paging
	- Sorting
	- A button that refreshes data about a movie from IMDB on demand.
	- Search quickly made with javascript




