<?

require_once '../models/Movie.php';
require_once '../models/Utilities.php';

class ImdbParsedMovies
{
  /** @var $movies Movie[] */
  private $movies;
  private $movieIds;
  private $movieHTML;

  public function __construct(array $ids)
  {
    $this->movieIds = $ids;
    $this->retrieveMovies();
  }

  private function retrieveMovies()
  {
    foreach ($this->movieIds as $id) {
      $movieHtml = $this->getMovieHtmlPage($id);
      if ($movie = $this->createMovie($movieHtml, $id)) {
        $this->movies[$id] = $movie;
      }
    }
  }

  public function getMovies()
  {
    return $this->movies;
  }

  private function getMovieHtmlPage($id)
  {
    $url = IMDB_URL . $id . '/';
    $data = Utilities::getFileData($url);
    return $data;
  }


  private function createMovie($html, $movieId)
  {

    $this->movieHTML = $html;

    $movie = new Movie(
      $this->getTitle(),
      $this->getDirectors(),
      $this->getActors(),
      $this->getGenres(),
      $movieId,
      $this->getRating(),
      $this->getRatingCount(),
      $this->getPlot(),
      $this->getYear(),
      $this->getRuntime(),
      $this->getPosterUrl(),
      $this->getAwards()
    );

    return $movie;
  }

  private function extractPartialHTML($start, $end, $html = false)
  {
    if ($html === null) {
      return null;
    }

    $html = ($html) ? $html : $this->movieHTML;
    $splitPage = explode($start, $html);
    if (!isset($splitPage[1])) {
      return null;
    }
    $extractedMiddle = explode($end, $splitPage[1], 2);
    return trim($extractedMiddle[0]);
  }

  private function getItemsUnderH4($headerName, $stopCharacter)
  {
    $directorsHtml = $this->extractPartialHTML('<h4 class="inline">' . $headerName, $stopCharacter);
    if (!$directorsHtml) {
      return null;
    }
    $directorsText = strip_tags($directorsHtml);
    $result = str_replace(array("\n", "  ", 's:', ':'), "", trim($directorsText, ":\n\t "));
    return $result;
  }

  private function getTitle()
  {
    return $this->extractPartialHTML('itemprop="name">', '<');
  }

  private function getDirectors()
  {
    return $this->getItemsUnderH4('Director', '</div>');
  }

  private function  getActors()
  {
    return $this->getItemsUnderH4('Stars', '|');
  }

  private function getGenres()
  {
    return $this->getItemsUnderH4('Genres', '</div>');
  }

  private function getRuntime()
  {
    return $this->getItemsUnderH4('Runtime', '</time>');
  }

  private function getPlot()
  {
    return $this->extractPartialHTML('itemprop="description">', '<');
  }

  private function getRating()
  {
    return $this->extractPartialHTML('span itemprop="ratingValue">', '<');
  }

  private function getRatingCount()
  {
    return $this->extractPartialHTML('itemprop="ratingCount">', '<');
  }

  private function getYear()
  {
    if ($partialHTML = $this->extractPartialHTML('<h1 class="header" itemprop="name">', '</h1>')) {
      $result = strip_tags($this->extractPartialHTML('<span class="nobr">(', ')', $partialHTML));
    }
    return isset($result) ? $result : null;
  }

  private function getPosterUrl()
  {
    if ($partialHTML = $this->extractPartialHTML('<div class="image">', '</div>')) {
      $imageUrl = $this->extractPartialHTML('src="', '"', $partialHTML);
    }
    return isset($imageUrl) ? $imageUrl : null;
  }

  private function getAwards()
  {
    $partialHTML = $this->extractPartialHTML('<div class="article highlighted" id="titleAwardsRanks">', '</div>');
    if (!$partialHTML) {
      return null;
    }

    $awardsText = strip_tags($partialHTML);
    $result = str_replace(array("\n", "  ", ':', 'See more awards&nbsp;&raquo;'), "", trim($awardsText, ":\n\t "));
    $result = str_replace(".A", ". A", $result);

    return $result;
  }

}

//end of ImdbParsedMovies.php