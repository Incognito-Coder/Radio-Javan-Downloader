<?php
//Incognito Coder
use RadioJavan\Downloader;

header('Content-type: application/json');
require('RJavan.php');
$request = new Downloader();
if (isset($_GET['link']) && !empty($_GET['link'])) {
    if (strpos($_GET['link'], 'mp3s'))
        echo $request->Download("music", $_GET['link']);
    elseif (strpos($_GET['link'], 'podcasts'))
        echo $request->Download("podcast", $_GET['link']);
    elseif (strpos($_GET['link'], 'videos'))
        echo $request->Download("video", $_GET['link']);
}