<?php
require_once 'config.php';
require_once 'classes/db.php';

global $db;
$db = new \classes\DB( DB_USER, DB_PASSWORD, DB_NAME, DB_HOST );