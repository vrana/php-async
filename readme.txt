MysqliAsync - Convenient API for asynchronous queries in PHP 5.3+
CurlAsync - Convenient API for asynchronous HTTP connections using CURL in PHP 5+



MysqliAsync API:

$db = new MysqliAsync([$host, [$username, [$passwd, [$dbname, [$port, [$socket]]]]]])
- specify default credentials

$db->$name($query, [$credentials])
- execute query
- $credentials are merged with defaults

$mysqli_result = $db->$name()
- get results of query identified by $name



CurlAsync API:

$http = new CurlAsync

$http->$name($url)
- execute request

$string = $http->$name()
- get result of request identified by $name



Czech articles:

http://php.vrana.cz/asynchronni-dotazy-v-mysqli.php
http://php.vrana.cz/asynchronni-dotazy-v-curl.php
