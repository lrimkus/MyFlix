<?
/** @var $movie Movie
 ** @var $this MyMoviesController
 */
$movies = $this->getMovies();
foreach ($movies as $movie):
  ?>
<div class="movie" id="<?=$movie->getMovieId()?>">
    <img src="/images/design/refresh_icon.png" alt="refresh" class="refresh-icon" onclick="refreshMovie('<?=$movie->getMovieId()?>')">

    <h1><?=$movie->getTitle()?> (<?=$movie->getReleaseYear()?>)</h1>
    <div class="poster">
        <img src="<?=$this->getConfig()->getPostersDirectory()?><?=$movie->getMovieId()?>.jpg" alt="<?=$movie->getTitle()?>" width="185"/>
    </div>
    <div class='movie_info'>
        <ul>
          <? if ($movie->getDirector()): ?>
            <li><span class='label'>Director:</span> <?=$movie->getDirector()?></li>
          <? endif; ?>

          <? if ($movie->getRating()): ?>
            <li>
                <span class='label'>Rating:</span> <?=$movie->getRating()?>
              <? if ($movie->getVotes()) : ?>
                <span class="small-note">(<?=$movie->getVotes()?> votes)</span>
              <? endif; ?>
            </li>
          <? endif; ?>

          <? if ($movie->getGenre()): ?>
            <li><span class='label'>Genre:</span> <?=$movie->getGenre()?></li>
          <? endif; ?>

          <? if ($movie->getRunTime()): ?>
            <li><span class='label'>Runtime:</span> <?=$movie->getRunTime()?></li>
          <? endif; ?>

          <? if ($movie->getMovieId()): ?>
            <li>
                <span class='label'>IMDB: </span><a href="http://www.imdb.com/title/<?=$movie->getMovieId()?>" target="_blank"><?=IMDB_URL . $movie->getMovieId()?></a>
            </li>
          <? endif; ?>

          <? if ($movie->getActors()): ?>
            <li><span class='label'>Actors:</span> <?=$movie->getActors()?></li>
          <? endif; ?>

          <? if ($movie->getPlot()): ?>
            <li><span class='label'>Plot:</span> <?=$movie->getPlot()?></li>
          <? endif; ?>

          <? if ($movie->getAwards()): ?>
            <li><span class='label'>Awards:</span> <?=$movie->getAwards()?></li>
          <? endif; ?>

        </ul>
    </div>
</div>
<? endforeach;

//end of tpl.movieBox.php
