<?php
//Incognito Coder ICDEV
use RadioJavan\Downloader;

header('Content-type: application/json');
require('RJavan.php');
$request = new Downloader();
if (isset($_GET['link']) && !empty($_GET['link'])) {
    $request->Recognize($_GET['link']);
    if ($request->MediaType() == 'music')
        echo $request->Download("music", $_GET['link']);
    elseif ($request->MediaType() == 'podcast')
        echo $request->Download("podcast", $_GET['link']);
    elseif ($request->MediaType() == 'video')
        echo $request->Download("video", $_GET['link']);
}
