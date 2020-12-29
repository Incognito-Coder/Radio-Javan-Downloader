<?php

use RadioJavan\Downloader;

require_once('RJavan.php');
$request = new Downloader();
echo $request->Download("music", 'https://rjplay.co/m/3q7Pyw3l');
