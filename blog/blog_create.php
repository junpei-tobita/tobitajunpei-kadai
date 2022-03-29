<?php
require_once('blog.php');
$blogs=$_POST;

$blog = new Blog();
$blog->blogVaridate($blogs);
$blog->blogCreate($blogs);


?>
<p><a href ="/index2.php">戻る</a></p>