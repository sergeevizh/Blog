<?php
header('Content-Type: text/html; charset=utf-8');
$code = file_get_contents('code.txt');
require 'app/include/Highlight.php';
$hl = new Highlight();
$res = $hl->highlightCode($code);
echo $res;