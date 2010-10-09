<?php
require_once __DIR__ . "/db.inc.php";

$start = microtime(true);

$db->a("SELECT SLEEP(2)");
$db->b("SELECT SLEEP(2)");

sleep(2);

$db->a();
$db->b();

echo (microtime(true) - $start) . "\n"; // should be slightly more than 2
