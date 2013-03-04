<?

class Utilities
{
  public static function checkImdbID($string)
  {
    $match = preg_match("/^tt[0-9]{7}$/", $string, $matches);

    if ($match === 1) {
      return true;
    }

    return false;
  }

  public static function getFileData($url)
  {
    $headers[] = "Accept-Language: en-us,en;q=0.5";
    $cURLOptions = array(
      CURLOPT_URL => $url,
      CURLOPT_HEADER => false,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_USERAGENT => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17',
      CURLOPT_HTTPHEADER => $headers
    );

    $cURL = curl_init();
    curl_setopt_array($cURL, $cURLOptions);

    try {
      $data = curl_exec($cURL);
    } catch (Exception $e) {
      return false;
    }

    curl_close($cURL);

    return $data;
  }
}

//end of Utilities.php