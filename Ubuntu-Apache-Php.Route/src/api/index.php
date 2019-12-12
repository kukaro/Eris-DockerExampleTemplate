<?php

$method = $_SERVER['REQUEST_METHOD'];
$uris = explode('/',$_SERVER['REQUEST_URI']);

require "{$uris[2]}/index.php";
