<?php

switch($_SERVER['REQUEST_METHOD']){
    case 'GET':
        echo '여기는 GET';
        break;
    case 'POST':
        echo '여기는 POST';
        break;
    case 'DELETE':
        echo '여기는 DELETE';
        break;
    case 'PUT':
        echo '여기는 PUT';
        break;
    default:
        require 'error.php';
}
