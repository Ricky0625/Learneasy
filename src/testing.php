<?php
$text = "Hello testing\nnewline";
$order = array("\r\n", "\n");
$replace = '<br />';

$newstr = str_replace($order, $replace, $text);
echo $newstr;

echo nl2br("One line. Another line.",false);
?>