<?php
header('Content-Type: text/html; charset=utf-8');
$code = file_get_contents('code.txt');
?>
<pre>
c=$(( $(($a)) + $(($b)) ))
</pre>
<hr>
<?php
require 'app/include/Highlight.php';
$hl = new Highlight();
$res = $hl->highlightBash($code);
echo $res;