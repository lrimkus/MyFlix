<? foreach($this->movie_obj as $m): ?>
<div class="movie">
	<h1><?=$m->get_title()?></h1>
	<div class="poster"><img  src="images/posters/<?=$m->get_imdb_id()?>.jpg" alt="<?=$m->get_title()?>"  width="185" /></div>
	<div class='movie_info'>
		<ul>
			<li><span class='label'>Year:</span> <?=$m->get_year()?>	<span class='smallnote'>(Released <?=$m->get_released()?>)</span></li>
			<li><span class='label'>Director:</span> <?=$m->get_director()?></li>
			<li><span class='label'>Rating:</span> <?=$m->get_rating()?> <span class="smallnote">(<?=$m->get_votes()?> votes)</span></li>
			<li><span class='label'>Genre:</span> <?=$m->get_genre()?></li>
			<li><span class='label'>Rated:</span> <?=$m->get_rated()?></li>
			<li><span class='label'>Runtime:</span> <?=$m->get_runtime()?></li>
			<li><span class='label'>IMDB:</span> <a href="http://www.imdb.com/title/<?=$m->get_imdb_id()?>" target="_blank" >http://www.imdb.com/title/<?=$m->get_imdb_id()?></a></li>
			<li><span class='label'>Actors:</span> <?=$m->get_actors()?></li>
			<li><span class='label'>Plot:</span> <?=$m->get_plot()?></li>
		</ul>
	</div>	
</div>
<? endforeach; ?>
