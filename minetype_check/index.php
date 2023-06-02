<?php

$url = '消える.jpg';
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->file($url);

echo $url;
echo "<pre>";
var_dump($mime_type);
echo "</pre>";

exit();
