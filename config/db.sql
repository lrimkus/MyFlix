CREATE TABLE movies (
  id text NOT NULL,
  title text NOT NULL,
  release_year text NOT NULL,
  directors text NOT NULL,
  rating text NOT NULL,
  votes text NOT NULL,
  genre text NOT NULL,
  runtime text NOT NULL,
  actors text NOT NULL,
  plot text NOT NULL,
  awards text,
  poster text NOT NULL,
  updated timestamp NULL DEFAULT NULL,
  added timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1