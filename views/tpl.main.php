<?
/** @var $this MyMoviesController */
$folders = $this->getConfig()->getFolders();

?><!DOCTYPE html>
<html>
<head>
    <title>MyFlicks</title>
    <link type="text/css" href="main.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <!-- Begin iOS tags -->
    <meta name="apple-mobile-web-app-status-bar-style" content="default"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="viewport" content="user-scalable=no, width=device-width"/>
    <link rel="apple-touch-icon-precomposed" href="/images/design/apple-touch-icon.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px)  and (orientation: portrait)  and (-webkit-device-pixel-ratio: 2)" href="/images/design/startup_vertical_1536x2008.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 768px)  and (orientation: landscape)  and (-webkit-device-pixel-ratio: 2)" href="/images/design/startup_horizontal_1496x2048.png"/>
    <link rel="apple-touch-startup-image" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)" href="/images/design/startup_vertical_640x920.png"/>
    <!--  End iOS tags -->
</head>
<body>
<div id="main">
    <div id="menu">
        <ul>
          <?
          $i = 1;
          foreach ($folders as $folderTitle => $folderPath) {
            print '<li ' . (($this->getCurrentFolder() == $folderPath) ? "class='action'" : "") . '><a href="?id=' . $i . '">' . $folderTitle . '</a></li>';
            $i++;
          } ?>
          <? if ($this->getConfig()->getUseCache()): ?>
            <li  <?=(($this->getCurrentFolder() == 'history') ? "class='action'" : "")?>>
                <a href="?id=history">history</a>
            </li>
          <? endif; ?>
        </ul>
    </div>
    <div id="content">
      <? require_once '../views/tpl.movieBox.php'; ?>
        <div class="movie">Total: <?=count($this->getMovies())?>
            <div class='top-link'><a href='#menu'>Go to Top</a></div>
        </div>
    </div>
</div>
<img src="/images/design/ajax_loader.gif" style="display:none" alt="Pre-loading ajax refresh icon."/>
</body>
</html>