<?php
require_once __DIR__ . "/db.inc.php";

$db->test1("SELECT 'test1'");
$db->test2("SELECT 'test2'");

print_r($db->test1()->fetch_row());
print_r($db->test2()->fetch_row());
