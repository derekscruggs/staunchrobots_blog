<?php
$s = $_SERVER;
$use_forwarded_host=false;

$ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
$sp = strtolower($s['SERVER_PROTOCOL']);
$protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
$port = $s['SERVER_PORT'];
$port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
$host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
$host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
$url = $protocol . '://' . $host . '/blog/wp-admin/';

header("Location:$url",true, '301');
die();