<?php
include dirname(__FILE__) . "/../CurlAsync.php";

$http = new CurlAsync;

$http->test1("http://localhost/");
$http->test2("http://localhost/");

var_dump($http->test1());
var_dump($http->test2());
