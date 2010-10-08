<?php
include __DIR__ . "/../MysqliAsync.php";

$db = new MysqliAsync("localhost");

$db->test1("SELECT 'test1'");
$db->test2("SELECT 'test2'");

print_r($db->test1()->fetch_row());
print_r($db->test2()->fetch_row());
