MysqliAsync - Convenient API for asynchronous queries in PHP 5.3+



API:

$db = new MysqliAsync([$host, [$username, [$passwd, [$dbname, [$port, [$socket]]]]]])
- specify default credentials

$db->$name($query, [$credentials])
- execute query
- $credentials are merged with defaults

$mysqli_result = $db->$name()
- get results of query identified by $name



Czech article:

http://php.vrana.cz/asynchronni-dotazy-v-mysqli.php
